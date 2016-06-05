<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 10/01/2016
 * Time: 21:43
 */

namespace Oni\TravelPortBundle\ProviderClients;

use Curl\Curl;
use Predis\Client as PredisClient;
use Symfony\Component\Config\Definition\Exception\Exception;

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

    /**
     * @var \Predis\Client
     */
    protected $redis;


    public function __construct($params = array())
    {

        if (empty($params['username']) || empty($params['password']))
            throw new \InvalidArgumentException('Username must be set to user WTS Api client');

        try{

            $this->redis = new PredisClient(
                array(
                "host" => "localhost",
                "port" => 6379
                )
            );

        }catch (Exception $e){

            throw $e;

        }

        $this->username = $params['username'];
        $this->password = $params['password'];
        $this->prepareParams();

    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function searchHotel($params = array())
    {

        if (isset($params['roomDetails'])) {
            $roomDetail = $params['roomDetails'];
            unset($params['roomDetails']);
        }


        $requestParams = $params;

        $this->requestParams = array_merge($this->requestParams, $requestParams);
        $url = $this->url.'?'.urldecode(http_build_query($this->requestParams)).'&roomDetails='.$roomDetail;
        $response = $this->sendRequest($url);

        return $this->processResponseData($response);

    }

    public function getCountries(){

        $cacheKey = 'WTS-COUNTRIES';

        if ($this->redis->exists($cacheKey)){

            return $this->processCacheResult($cacheKey);

        }else {

            $requestParams = array(
                'action' => 'get_country'
            );
            $this->requestParams = array_merge( $this->requestParams,
                $requestParams );
            $response = $this->sendRequest( $this->url . '?' . urldecode( http_build_query( $this->requestParams ) ) );

            return $this->processResponseData( $response , $cacheKey);

        }

    }

    public function getNationalities(){

        $cacheKey = 'WTS-NATIONALITIES';

        if ($this->redis->exists($cacheKey)){

            return $this->processCacheResult($cacheKey);

        }else {

            $requestParams = array(
                'action' => 'get_nationalities'
            );
            $this->requestParams = array_merge( $this->requestParams,
                $requestParams );
            $response = $this->sendRequest( $this->url . '?' . urldecode( http_build_query( $this->requestParams ) ) );

            return $this->processResponseData( $response , $cacheKey);

        }

    }
    
    public function processCacheResult($cacheKey){

        $result = $this->redis->get($cacheKey);

        return $this->isJson($result) ? json_decode($result) : $result ;

    }

    public function getCities($wtsCountryCode){


        $cacheKey = 'WTS-CITIES-'.$wtsCountryCode;

        if ($this->redis->exists($cacheKey)){

            return $this->processCacheResult($cacheKey);

        }else {

            $requestParams       = array(
                'action' => 'getcity',
                'country' => $wtsCountryCode
            );
            $this->requestParams = array_merge( $this->requestParams,
                $requestParams );
            $response            = $this->sendRequest( $this->url . '?' . urldecode( http_build_query( $this->requestParams ) ) );

            return $this->processResponseData( $response , $cacheKey );

        }

    }


    function isJson($string,$return_data = false) {
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
    }

    /**
     * @param $response
     *
     * @return array
     * @throws \Exception
     */
    public function processResponseData($response, $cacheKey = false){

        if (!empty($response['results']) && $this->isJson($response['results'])){

            $results = $response['results'];

            if ($this->isCacheEnabled() && !empty($cacheKey)){

                $this->redis->set($cacheKey, $results);

            }

            return json_decode($results) ;

        }elseif ($response['error']){

            throw new \HttpResponseException('WTS API Error message : '.$response['error']);

        }else{

            throw new \Exception('Invalid response from WTS API');

        }

    }


    public function isCacheEnabled(){

        return $this->redis;

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

    public function getHotelDetails($params)
    {

        if (!isset($params['hotelId']) || !isset($params['searchId'])) {
            throw new \HttpRequestException('Wts Api method getHotelDetails parameters hotelId and searchId must be set');
        }

        $requestParams = [
            'action'   => 'hotel_detail',
            'hotel_id' => $params['hotelId'],
            'unique_id'=> $params['searchId']
        ];

        $this->requestParams = array_merge($this->requestParams, $requestParams);
        $url = $this->url.'?'.urldecode(http_build_query($this->requestParams));
        $response = $this->sendRequest($url);

        return $this->processResponseData($response);

    }






}