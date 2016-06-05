<?php

namespace Oni\TravelPortBundle\ProviderSupport;



interface HotelProviderInterface extends ProviderInterface
{

    const HOTEL_SEARCH_REQUEST = 1;
    const HOTEL_BOOKING_REQUEST = 2;

    public function searchHotel(array $hotelFormData);

    public function bookHotelReservation();

}