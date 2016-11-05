<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 07/06/2016
 * Time: 01:03
 */

namespace Oni\TravelPortBundle\Providers\DataObjects\Hotel;


class HotelRoom {

    protected $providerRoomResponse;
    protected $totalRate;
    protected $roomType;
    protected $roomName;
    protected $mealBasis;
    protected $nightlyRate;

    /**
     * @return mixed
     */
    public function getProviderRoomResponse()
    {
        return $this->providerRoomResponse;
    }

    /**
     * @param mixed $providerRoomResponse
     *
     * @return HotelRoom
     */
    public function setProviderRoomResponse($providerRoomResponse)
    {
        $this->providerRoomResponse = $providerRoomResponse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalRate()
    {
        return $this->totalRate;
    }

    /**
     * @param mixed $totalRate
     *
     * @return HotelRoom
     */
    public function setTotalRate($totalRate)
    {
        $this->totalRate = $totalRate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoomType()
    {
        return $this->roomType;
    }

    /**
     * @param mixed $roomType
     *
     * @return HotelRoom
     */
    public function setRoomType($roomType)
    {
        $this->roomType = $roomType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoomName()
    {
        return $this->roomName;
    }

    /**
     * @param mixed $roomName
     *
     * @return HotelRoom
     */
    public function setRoomName($roomName)
    {
        $this->roomName = $roomName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMealBasis()
    {
        return $this->mealBasis;
    }

    /**
     * @param mixed $mealBasis
     *
     * @return HotelRoom
     */
    public function setMealBasis($mealBasis)
    {
        $this->mealBasis = $mealBasis;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNightlyRate()
    {
        return $this->nightlyRate;
    }

    /**
     * @param mixed $nightlyRate
     *
     * @return HotelRoom
     */
    public function setNightlyRate($nightlyRate)
    {
        $this->nightlyRate = $nightlyRate;

        return $this;
    }




}