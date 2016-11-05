<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 07/06/2016
 * Time: 00:33
 */

namespace Oni\TravelPortBundle\Providers\DataObjects\Hotel;

use Doctrine\Common\Collections\ArrayCollection;
use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Currency;
use Oni\TravelPortBundle\Providers\DataObjects\HotelInterface;

/**
 * Class Hotel
 * @package Oni\TravelPortBundle\Providers\DataObjects\Hotel
 */
class Hotel implements HotelInterface{
	/**
	 *
	 *
	 * @access private
	 * @var mixed
	 */
	private $hotelResponse;

	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $uniqueProviderRequestId;

	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $providerKey;

	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $providerHotelId;

	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $name;

	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $description;

	/**
	 *
	 *
	 * @access private
	 * @var ArrayCollection
	 */
	private $hotelImages;

	/**
	 *
	 *
	 * @access private
	 * @var mixed
	 */
	private $startRate;

	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $latitude;

	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $longitude;

	/**
	 *
	 *
	 * @access private
	 * @var integer
	 */
	private $totalNights;

	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $address;


	/**
	 *
	 *
	 * @access private
	 * @var string
	 */
	private $currencyCode;

	/**
	 *
	 *
	 * @access private
	 * @var integer
	 */
	private $rating;

	/**
	 *
	 *
	 * @access private
	 * @var ArrayCollection
	 */
	private $rooms;

	/**
	 * @var Currency
	 */
	private $currency;

	/**
	 * @var City
	 */
	private $city;


	/**
	 * Get raw hotel API response
	 *
	 * @access public
	 * @return mixed
	 */
	public function getHotelResponse() {
		return $this->hotelResponse;
	}

	/**
	 * Set raw hotel API response
	 *
	 * @access public
	 * @param ARGTYPE $hotelResponse
	 * @return self
	 */
	public function setHotelResponse( $hotelResponse ) {
		$this->hotelResponse = $hotelResponse;
	}

	/**
	 * @access public
	 * @return string
	 */
	public function getUniqueProviderRequestId() {
		return $this->uniqueProviderRequestId;
	}

	/**
	 * @access public
	 * @param string $uniqueProviderRequestId
	 * @return self
	 */
	public function setUniqueProviderRequestId( $uniqueProviderRequestId ) {
		$this->uniqueProviderRequestId = $uniqueProviderRequestId;
		return $this;
	}

	/**
	 * @access public
	 * @return string
	 */
	public function getProviderKey() {
		return $this->providerKey;
	}

	/**
	 * @access public
	 * @param string $providerKey
	 * @return self
	 */
	public function setProviderKey( $providerKey ) {
		$this->providerKey = $providerKey;
		return $this;
	}

	/**
	 * @access public
	 * @return string
	 */
	public function getProviderHotelId() {
		return $this->providerHotelId;
	}

	/**
	 * @access public
	 * @param string $providerHotelId
	 * @return self
	 */
	public function setProviderHotelId( $providerHotelId ) {
		$this->providerHotelId = $providerHotelId;
		return $this;
	}

	/**
	 * @access public
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @access public
	 * @param string $name
	 * @return self
	 */
	public function setName( $name ) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @access public
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @access public
	 * @param string $description
	 * @return self
	 */
	public function setDescription( $description ) {
		$this->description = $description;
		return $this;
	}

	/**
	 * @access public
	 * @return ArrayCollection
	 */
	public function getHotelImages() {
		return $this->hotelImages;
	}

	/**
	 * Add HotelImage
	 *
	 * @access public
	 * @param HotelImage $hotelImage
	 * @return self
	 */
	public function addHotelImage(HotelImage $hotelImage) {
		$this->hotelImages[] = $hotelImage;
		return $this;
	}

	/**
	 * Add HotelImage
	 *
	 * @access public
	 * @param HotelImage $hotelImage
	 */
	public function removeHotelImage(HotelImage $hotelImage) {
		$this->hotelImages->removeElement($hotelImage);
	}

	/**
	 * Get starting price (lowest price)
	 *
	 * @access public
	 * @return string
	 */
	public function getStartRate() {
		return $this->startRate;
	}

	/**
	 * Set starting price (lowest price)
	 *
	 * @access public
	 * @param string $startRate
	 * @return self
	 */
	public function setStartRate( $startRate ) {
		$this->startRate = $startRate;
		return $this;
	}

	/**
	 * @access public
	 * @return string
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * @access public
	 * @param string $latitude
	 * @return self
	 */
	public function setLatitude( $latitude ) {
		$this->latitude = $latitude;
		return $this;
	}

	/**
	 * @access public
	 * @return integer
	 */
	public function getTotalNights() {
		return $this->totalNights;
	}

	/**
	 * @access public
	 * @param integer $totalNights
	 * @return self
	 */
	public function setTotalNights( $totalNights ) {
		$this->totalNights = $totalNights;
		return $this;
	}

	/**
	 * Get Hotel Address
	 *
	 * @access public
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Set Hotel Address
	 *
	 * @access public
	 * @param string $address
	 * @return self
	 */
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

	/**
	 * @access public
	 * @return string RETURNDESCRIPTION
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * @access public
	 * @param string $longitude
	 * @return self
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
		return $this;
	}

	/**
	 * @access public
	 * @return string
	 */
	public function getCurrencyCode() {
		return $this->currencyCode;
	}

	/**
	 * @access public
	 * @param string $currencyCode
	 * @return self
	 */
	public function setCurrencyCode($currencyCode) {
		$this->currencyCode = $currencyCode;
		return $this;
	}

	/**
	 * Get hotel rating
	 *
	 * @access public
	 * @return integer
	 */
	public function getRating() {
		return $this->rating;
	}

	/**
	 * Set hotel rating
	 *
	 * @access public
	 * @param integer $rating
	 * @return self
	 */
	public function setRating( $rating ) {
		$this->rating = $rating;
		return $this;
	}

	/**
	 * Get all rooms attributed to hotel
	 *
	 * @access public
	 * @return ArrayCollection
	 */
	public function getRooms() {
		return $this->rooms;
	}

	/**
	 * Add Room to Hotel
	 *
	 * @access public
	 * @param HotelRoom $room
	 * @return self
	 */
	public function addRoom( HotelRoom $room ) {
		$this->rooms[] = $room;
		return $this;
	}

	/**
	 * Add Room to Hotel
	 *
	 * @access public
	 *
	 * @param HotelRoom $room
	 */
	public function removeRoom( HotelRoom $room ) {
		$this->rooms->removeElement($room);
	}

	/**
	 * Get currency
	 *
	 * @access public
	 * @return Currency
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * @access public
	 * @param Currency $currency
	 * @return self
	 */
	public function setCurrency(Currency $currency ) {
		$this->currency = $currency;
		return $this;
	}

	/**
	 * @access public
	 * @return City
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @access public
	 * @param City $city
	 * @return self
	 */
	public function setCity(City $city) {
		$this->city = $city;
		return $this;
	}
}