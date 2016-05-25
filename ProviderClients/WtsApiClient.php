<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 10/01/2016
 * Time: 21:43
 */

namespace Oni\TravelPortBundle\ProviderClients;

use Curl\Curl;

/***
 *
 * Class WtsApiClient
 * @package Oni\TravelPortBundle\ProviderClients
 * @author Peter Atkins <peter.atkins85@gmail.com>
 *
 */
class WtsApiClient
{

    /** @var  string */
    protected $username;

    /** @var  string */
    protected $password;

    /** @var  array */
    protected $requestParams;

    protected $url = 'http://alpha.new.wts-travel.com/WSV1/index.php';


    public function __construct($params = array())
    {

        if (empty($params['username']) || empty($params['password']))
            throw new \InvalidArgumentException('Username must be set to user WTS Api client');

        $this->username = $params['username'];
        $this->password = $params['password'];
        $this->prepareParams();

    }

    /**
     *
     * Search hotel
     *
     * @param array $params
     *
     * returns array
     *
     */
    public function searchHotel($params = array())
    {

        $roomDetail = '['.json_encode(array(
                'numberOfAdults' => '1',
                'numberOfChild' => '0',
                'ChildAge' => '0'
            )
        ).']';

        $requestParams = array(
            'action'            => 'hotel_search',
            'checkin_date'      => isset($params['checkin_date'])    ? $params['checkin_date']    : 1,
            'checkout_date'     => isset($params['checkout_date'])   ? $params['checkout_date']   : 1,
            'sel_country'       => isset($params['sel_country'])     ? 67     : 1,
            'sel_city'          => isset($params['sel_city'])        ? 'DUBAI'       : 1,
            'chk_ratings'       => isset($params['chk_ratings'])     ? $params['chk_ratings']     : 1,
            'sel_nationality'   => isset($params['sel_nationality']) ? $params['sel_nationality'] : 1,
            'sel_currency'      => isset($params['sel_currency'])    ? $params['sel_currency']    : 1,
            'availableonly'     => isset($params['availableonly'])   ? $params['availableonly']   : 0,
            'number_of_rooms'   => isset($params['number_of_rooms']) ? $params['number_of_rooms'] : 1,
            'gzip'              => isset($params['gzip'])            ? $params['gzip']            : 0,
        );

        $this->requestParams = array_merge($this->requestParams, $requestParams);
        return $this->sendRequest($this->url.'?'.urldecode(http_build_query($this->requestParams)).'&roomDetails='.$roomDetail);

        return json_decode($response, true);

    }
    /***
     *
     * Prepare for api call request
     *
     * @return array $request
     *
     */
    public function prepareParams(){

        $this->requestParams = array(
          'username' => $this->username,
          'password' => $this->password,
        );

    }


    public function sendRequest($url , $method = 'GET' , $data = []){

        $curl = curl_init();
        $response = [
            'results' => '{}',
            'error'   => false,
        ];

        curl_setopt($curl,CURLOPT_URL, $url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);

        $response['results'] = curl_exec($curl);

        if(!curl_errno($curl)){
            $info = curl_getinfo($curl);
            $response['total_time'] = $info['total_time'];
            $response['info'] = $info['url'];
        } else {
            $response['error'] = curl_error($curl);
        }

       curl_close($curl);

        return $response;

    }

    public function getHotelDetails()
    {


    }






}