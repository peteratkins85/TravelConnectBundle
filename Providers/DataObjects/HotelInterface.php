<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 07/06/2016
 * Time: 01:19
 */

namespace Oni\TravelPortBundle\Providers\DataObjects;

use Doctrine\Common\Collections\ArrayCollection;
use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Currency;
use Oni\TravelPortBundle\Providers\DataObjects\Hotel\HotelRoom;
use Oni\TravelPortBundle\Providers\DataObjects\Hotel\HotelImage;

interface HotelInterface {

	/**
	 * Get raw hotel API response
	 *
	 * @access public
	 * @return mixed
	 */
	public function getHotelResponse();

	/**
	 * Set raw hotel API response
	 *
	 * @access public
	 *
	 * @param ARGTYPE $hotelResponse
	 *
	 * @return self
	 */
	public function setHotelResponse( $hotelResponse );

	/**
	 * @access public
	 * @return string
	 */
	public function getUniqueProviderRequestId();

	/**
	 * @access public
	 *
	 * @param string $uniqueProviderRequestId
	 *
	 * @return self
	 */
	public function setUniqueProviderRequestId( $uniqueProviderRequestId );

	/**
	 * @access public
	 * @return string
	 */
	public function getProviderKey();

	/**
	 * @access public
	 *
	 * @param string $providerKey
	 *
	 * @return self
	 */
	public function setProviderKey( $providerKey );

	/**
	 * @access public
	 * @return string
	 */
	public function getProviderHotelId();

	/**
	 * @access public
	 *
	 * @param string $providerHotelId
	 *
	 * @return self
	 */
	public function setProviderHotelId( $providerHotelId );

	/**
	 * @access public
	 * @return string
	 */
	public function getName();

	/**
	 * @access public
	 *
	 * @param string $name
	 *
	 * @return self
	 */
	public function setName( $name );

	/**
	 * @access public
	 * @return string
	 */
	public function getDescription();

	/**
	 * @access public
	 *
	 * @param string $description
	 *
	 * @return self
	 */
	public function setDescription( $description );

	/**
	 * @access public
	 * @return ArrayCollection
	 */
	public function getHotelImages();

	/**
	 * Add HotelImage
	 *
	 * @access public
	 *
	 * @param HotelImage $hotelImage
	 *
	 * @return self
	 */
	public function addHotelImage( HotelImage $hotelImage );

	/**
	 * Add HotelImage
	 *
	 * @access public
	 *
	 * @param HotelImage $hotelImage
	 */
	public function removeHotelImage( HotelImage $hotelImage );

	/**
	 * Get starting price (lowest price)
	 *
	 * @access public
	 * @return string
	 */
	public function getStartRate();

	/**
	 * Set starting price (lowest price)
	 *
	 * @access public
	 *
	 * @param string $startRate
	 *
	 * @return self
	 */
	public function setStartRate( $startRate );

	/**
	 * @access public
	 * @return string
	 */
	public function getLatitude();

	/**
	 * @access public
	 *
	 * @param string $latitude
	 *
	 * @return self
	 */
	public function setLatitude( $latitude );

	/**
	 * @access public
	 * @return integer
	 */
	public function getTotalNights();

	/**
	 * @access public
	 *
	 * @param integer $totalNights
	 *
	 * @return self
	 */
	public function setTotalNights( $totalNights );

	/**
	 * Get Hotel Address
	 *
	 * @access public
	 * @return string
	 */
	public function getAddress();

	/**
	 * Set Hotel Address
	 *
	 * @access public
	 *
	 * @param string $address
	 *
	 * @return self
	 */
	public function setAddress( $address );

	/**
	 * @access public
	 * @return string RETURNDESCRIPTION
	 */
	public function getLongitude();

	/**
	 * @access public
	 *
	 * @param string $longitude
	 *
	 * @return self
	 */
	public function setLongitude( $longitude );

	/**
	 * @access public
	 * @return string
	 */
	public function getCurrencyCode();

	/**
	 * @access public
	 *
	 * @param string $currencyCode
	 *
	 * @return self
	 */
	public function setCurrencyCode( $currencyCode );

	/**
	 * Get hotel rating
	 *
	 * @access public
	 * @return integer
	 */
	public function getRating();

	/**
	 * Set hotel rating
	 *
	 * @access public
	 *
	 * @param integer $rating
	 *
	 * @return self
	 */
	public function setRating( $rating );

	/**
	 * Get all rooms attributed to hotel
	 *
	 * @access public
	 * @return ArrayCollection
	 */
	public function getRooms();

	/**
	 * Add Room to Hotel
	 *
	 * @access public
	 *
	 * @param HotelRoom $room
	 *
	 * @return self
	 */
	public function addRoom( HotelRoom $room );

	/**
	 * Add Room to Hotel
	 *
	 * @access public
	 *
	 * @param HotelRoom $room
	 */
	public function removeRoom( HotelRoom $room );

	/**
	 * Get currency
	 *
	 * @access public
	 * @return Currency
	 */
	public function getCurrency();

	/**
	 * @access public
	 *
	 * @param Currency $currency
	 *
	 * @return self
	 */
	public function setCurrency( Currency $currency );

	/**
	 * @access public
	 * @return City
	 */
	public function getCity();

	/**
	 * @access public
	 *
	 * @param City $city
	 *
	 * @return self
	 */
	public function setCity( City $city );

}