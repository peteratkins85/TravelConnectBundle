<?php

namespace Oni\TravelPortBundle\Providers\Wts;

use Doctrine\Common\Collections\ArrayCollection;
use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Country;
use Oni\CoreBundle\Entity\Currency;
use Oni\CoreBundle\Entity\Nationality;
use Oni\TravelPortBundle\Exceptions\InvalidProviderRequestException;
use Oni\TravelPortBundle\Providers\DataObjects\Hotel\Hotel;
use Oni\TravelPortBundle\Providers\DataObjects\Hotel\HotelImage;
use Oni\TravelPortBundle\Providers\DataObjects\Hotel\HotelRoom;
use Oni\TravelPortBundle\ProviderSupport\AbstractProvider;
use Oni\TravelPortBundle\ProviderSupport\HotelProviderInterface;
use Oni\TravelPortBundle\TravelPortGlobals;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class WTSProvider
 *
 * http://www.wts-travel.com/
 *
 * @package Oni\TravelPortBundle\Providers
 * @author Peter Atkins <peter.atkins85@gmail.com>
 *
 *
 */
class WtsProvider extends AbstractProvider implements HotelProviderInterface
{

    /** @var  ContainerInterface */
    protected $container;

    /** @var  WtsApiClient */
    protected $apiClient;

    /** @var array */
    private $wtsCountries;

    /** @var array */
    private $wtsNationalities;

    /** @var  Country */
    public $country;

    /** @var  City */
    public $city;

    /** @var  Currency */
    public $currency;

    /** @var  int */
    public $totalNights;

    /**  @var string */
    private $wtsSearchId;

    private $wtsResponse;

    /** @var \Predis\Client */
    protected $cacheManager;

    /** @var array */
    private $hotelNames;


    public function __construct(ContainerInterface $container)
    {
        $this->container    = $container;
        $this->apiClient    = $this->container->get('oni_travel_port_provider_client.wts');
        $this->cacheManager = $container->get('snc_redis.default');
    }

    protected function setParams($requestData)
    {

        $this->country  = isset($requestData['country']) ? $requestData['country'] : null;
        $this->city     = isset($requestData['city']) ? $requestData['city'] : null;
        $this->currency = isset($requestData['currency']) ? $requestData['currency'] : null;

    }

    public function searchHotel(array $hotelFormData)
    {

        $this->setParams($hotelFormData);

        $country           = $this->getWtsCountryCode($hotelFormData['country']);
        $city              = $this->getWtsCityCode($hotelFormData['city'],
            $country);
        $nationality       = $this->getWtsNationalityCode($hotelFormData['nationality']);
        $ratings           = $this->formatRating($hotelFormData['rating']);
        $checkInDate       = $hotelFormData['checkIn']->format('d/m/Y');
        $checkOutDate      = $hotelFormData['checkOut']->format('d/m/Y');
        $interval          = $hotelFormData['checkIn']->diff($hotelFormData['checkOut']);
        $this->totalNights = $interval->format('%a');
        $currency          = $hotelFormData['currency']->getCurrencyCode();
        $availableOnly     = 1;
        $rooms             = $hotelFormData['numberOfRooms'];
        $adults            = $hotelFormData['adults'];
        $children          = $hotelFormData['children'];


        $roomDetail = '[' . json_encode(array(
                    'numberOfAdults' => $adults,
                    'numberOfChild'  => '0',
                    'ChildAge'       => '0',
                )
            ) . ']';

        $request = array(
            'action'                => 'hotel_search',
            'checkin_date'          => $checkInDate,
            'checkout_date'         => $checkOutDate,
            'sel_country'           => $country,
            'sel_city'              => $city,
            'chk_ratings'           => $ratings,
            'sel_nationality'       => $nationality,
            'sel_currency'          => $currency,
            'availableonly'         => $availableOnly,
            'number_of_rooms'       => $rooms,
            'gzip'                  => 1,
            'limit_hotel_room_type' => 1,
            'roomDetails'           => $roomDetail,
        );

        $response = $this->formatResponse($this->apiClient->searchHotel($request),
            self::HOTEL_SEARCH_REQUEST);


        return $response;


    }

    protected function formatResponse($response, $requestType)
    {

        $this->wtsResponse = $response;
        if ($response->TotalCount < 1) {
            return false;
        }

        switch ($requestType) {

            case self::HOTEL_SEARCH_REQUEST :
                $response = $this->compileHotelList($response->HotelList);
            default:

        }

        return json_decode(json_encode($response));

    }

    /**
     * @param $hotelList
     *
     * @return array
     */
    protected function compileHotelList($hotelList):array
    {

        $hotels    = [];
        $hotelName = [];

        foreach ($hotelList as $hotel) {

            $serializedHotelName = $this->serializeValue($hotel->HotelName);

            if ( ! isset($hotelName[$serializedHotelName])) {

                $hotelDetails = $this->getHotelDetails($this->wtsResponse->SearchUniqueId,
                    $hotel->HotelId);

                $hotel = new Hotel();
                $hotel->setHotelResponse($hotel)
                    ->setUniqueProviderRequestId($this->wtsResponse->searchUniqueId)
                    ->setProviderKey($this->getProviderKey())
                    ->setProviderHotelId($hotel->HotelId)
                    ->setName(ucwords(strtolower($hotel->HotelName)))
                    ->setDescription($hotelDetails->Description)
                    ->setStartRate(round($hotel->TotalCharges))
                    ->setLatitude($hotelDetails->Latitude)
                    ->setLongitude($hotelDetails->Longitude)
                    ->setTotalNights($this->totalNights)
                    ->setAddress($hotelDetails->HotelAddress)
                    ->setCurrencyCode($hotel->RateCurrencyCode)
                    ->setRating((int)$hotelDetails->HotelRating)
                    ->setCurrency($this->currency)
                    ->getCity($this->city);


                foreach ($hotelDetails->HotelImages as $hotelImage) {

                    $hotelImage = new HotelImage();
                    $hotelImage->setLargeImage($hotelImage->BigUrl)
                        ->setThumbImage($hotelImage->ThumbnailUrl);

                    $hotel->addHotelImage($hotelImage);

                }

                foreach ($hotel->HotelProperty as $room) {

                    if (isset($room->RoomRates[0])) {

                        $hotelRoom = new HotelRoom();

                        $hotelRoom->setProviderRoomResponse($room->RoomRates[0])
                            ->setNightlyRate(round($room->RoomRates[0]->RateBreakup[0]->DisplayNightlyRate))
                            ->setMealBasis($room->RoomRates[0]->MealBasis)
                            ->setRoomName($room->RoomRates[0]->RoomCategory)
                            ->setTotalRate(round($room->DisplayRoomRate))
                            ->setRoomType($room->RoomRates[0]->RoomType);

                        $hotel->addRoom($hotelRoom);

                    }

                }

                $hotels[] = $hotel;

                $hotelName[$serializedHotelName] = true;

            }

        }

        return $hotels;

    }


    protected function formatRoomList($roomList)
    {

        $rooms = [];

        foreach ($roomList as $room) {

            if (isset($room->RoomRates[0])) {

                $rooms[] = [
                    'providerRoomResponse' => $room->RoomRates[0],
                    'totalRate'            => round($room->DisplayRoomRate),
                    'roomType'             => $room->RoomRates[0]->RoomType,
                    'roomName'             => $room->RoomRates[0]->RoomCategory,
                    'mealBasis'            => $room->RoomRates[0]->MealBasis,
                    'nightlyRate'          => round($room->RoomRates[0]->RateBreakup[0]->DisplayNightlyRate),
                ];

            }

        }

        return json_decode(json_encode($rooms));

    }

    public function serializeValue($value)
    {

        return md5(str_replace(' ', '', strtoupper($value)));

    }

    private function getHotelDetails($wtsSearchId, $wtsHotelId)
    {

        $cacheKey = 'WTS-API-HOTEL-DETAILS_' . $wtsHotelId;

        if ($this->cacheManager->exists($cacheKey)) {

            return json_decode($this->cacheManager->get($cacheKey));

        } else {

            $request = array(
                'hotelId'  => $wtsHotelId,
                'searchId' => $wtsSearchId,
            );

            $response = $this->apiClient->getHotelDetails($request);

            $this->cacheManager->set($cacheKey, json_encode($response));

            return $response;

        }

    }

    protected function addHotelImages($hotelImages)
    {

        $images = [];

        foreach ($hotelImages as $hotelImage) {

            $images[] = [
                'thumbImage' => $hotelImage->ThumbnailUrl,
                'largeImage' => $hotelImage->BigUrl,
            ];

        }

        return $images;

    }


    private function formatRating($rating)
    {

        foreach ($rating as &$rate) {
            $rate = $rate . '.0';
        }
        $rating = implode(',', $rating);

        return $rating;

    }


    private function getWtsCountryCode($countryData)
    {

        $counties       = $this->getWtsCountries();
        $wtsCountryCode = false;

        if (is_array($counties) && ! empty($counties)) {

            foreach ($counties as $country) {

                if (strtoupper(trim($country->name)) == strtoupper(trim($countryData->getName()))) {

                    $wtsCountryCode = $country->code;
                    break;

                }

            }

            if ( ! $wtsCountryCode) {
                throw new \Exception('Wts code not found for country ' . $countryData->getName() . ' !');
            }

        } else {

            throw new \Exception('Unable to retrieve country list from WTS API');

        }

        return $wtsCountryCode;

    }

    private function getWtsCityCode($cityData, $wtsCountryCode)
    {

        $cities      = $this->apiClient->getCities($wtsCountryCode);
        $wtsCityCode = false;

        if ( ! empty($cities->citiy_info) && is_array($cities->citiy_info)) {

            foreach ($cities->citiy_info as $city) {

                if (strtoupper(trim($city->name)) == strtoupper(trim($cityData->getCityName()))) {

                    $wtsCityCode = $city->city_code;
                    break;

                }

            }

            if ( ! $wtsCityCode) {
                throw new \Exception('Wts code not found for city ' . $cityData->getCityName() . ' !');
            }

        } else {

            throw new \Exception('Unable to retrieve city list from WTS API');

        }

        return $wtsCityCode;

    }

    private function getWtsNationalityCode(Nationality $nationalityData)
    {

        $wtsNationalityCode = false;
        $nationalities      = $this->getWtsNationalities();

        if ( ! empty($nationalities->nationalities_info) && is_array($nationalities->nationalities_info)) {

            foreach ($nationalities->nationalities_info as $nationality) {

                if (strtoupper(trim($nationality->Nationality)) == strtoupper(trim($nationalityData->getNationality()))) {

                    $wtsNationalityCode = $nationality->Code;
                    break;

                }

            }

            if ( ! $wtsNationalityCode) {
                throw new \Exception('Wts code not found for nationality ' . $nationalityData->getNationality() . ' !');
            }

        } else {

            throw new \Exception('Unable to retrieve nationality list from WTS API');

        }

        return $wtsNationalityCode;

    }


    private function getWtsCountries()
    {

        if (empty($this->wtsCountries)) {
            $this->wtsCountries = $this->apiClient->getCountries();
        }

        return $this->wtsCountries;

    }

    private function getWtsNationalities()
    {

        if (empty($this->wtsNationalities)) {
            $this->wtsNationalities = $this->apiClient->getNationalities();
        }

        return $this->wtsNationalities;

    }


    public function bookHotelReservation()
    {
        // TODO: Implement bookHotel() method.
    }
}