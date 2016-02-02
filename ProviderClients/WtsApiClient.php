<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 10/01/2016
 * Time: 21:43
 */

namespace Oni\TravelConnectBundle\ProviderClients;

use Guzzle\Service\Client;
use Symfony\Component\Config\Definition\Exception\Exception;
use Guzzle\Common\Collection;
use Guzzle\Http\Message\RequestFactory;

class WtsApiClient extends Client
{

    /** @var  string */
    protected $username;

    /** @var  string */
    protected $password;

    /** @var  array */
    protected $requestParams;

    /** @var bool  */
    protected $ssl = false;

    public function __construct($params = array())
    {

        if (empty($params['username']) || empty($params['password']))
            throw new Exception('Username must be set to user WTS Api client');

        if (!extension_loaded('curl')) {
            // @codeCoverageIgnoreStart
            throw new RuntimeException('The PHP cURL extension must be installed to use Guzzle.');
            // @codeCoverageIgnoreEnd
        }
        $config = new Collection();

        $this->setConfig($config);
        //$this->initSsl();
        $this->setBaseUrl('http://alpha.new.wts-travel.com/');
        $this->defaultHeaders = new Collection();
        $this->setRequestFactory(RequestFactory::getInstance());
        $this->userAgent = $this->getDefaultUserAgent();


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
     */
    public function searchHotel($params = array())
    {
        $roomDetail = json_encode(array(
            'numberOfAdults' => 2,
            'numberOfChild' => 0,
            'ChildAge' => 0
          )
        );

        $requestParams = array(
            'action'            => 'hotel_search',
            'checkin_date'      => isset($params['checkin_date'])    ? $params['checkin_date']    : 1,
            'checkout_date'     => isset($params['checkout_date'])   ? $params['checkout_date']   : 1,
            'sel_country'       => isset($params['sel_country'])     ? $params['sel_country']     : 1,
            'sel_city'          => isset($params['sel_city'])        ? $params['sel_city']        : 1,
            'chk_ratings'       => isset($params['chk_ratings'])     ? $params['chk_ratings']     : 1,
            'sel_nationality'   => isset($params['sel_nationality']) ? $params['sel_nationality'] : 1,
            'sel_currency'      => isset($params['sel_currency'])    ? $params['sel_currency']    : 1,
            'availableonly'     => isset($params['availableonly'])   ? $params['availableonly']   : 0,
            'number_of_rooms'   => isset($params['number_of_rooms']) ? $params['number_of_rooms'] : 1,
            'twin1'             => isset($params['twin1'])           ? $params['twin1']           : false,
            'roomDetails'       => isset($params['roomDetails'])     ? $params['roomDetails']     : $roomDetail,
            'gzip'              => isset($params['gzip'])            ? $params['gzip']            : 0,
        );

        $this->requestParams = array_merge($this->requestParams, $requestParams);

        $request = $this->get('http://alpha.new.wts-travel.com/WSV1/index.php?'.http_build_query($this->requestParams));

        $response = $request->send()->json();

        return $response;

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

    public function getHotelDetails()
    {


    }

    public function makeCall(){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ($this->ssl ? 'https://'  : 'http://' ) . $this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect: ') );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($this->connectionTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);
        }

        if ($this->timeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        }

        if($this->ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        $this->RAWresponse = curl_exec($ch);
        $this->response = array();
        $this->errno = curl_errno($ch);
        $this->err_str = curl_error($ch);
        $this->curl_getinfo = curl_getinfo($ch);

        curl_close($ch);

        if ($this->errno > 0) {
            trigger_error('SpectrumAPIClient Request Failed: ' . $this->errno . ' - ' . $this->err_str);
            DisplayErrMsg('SpectrumAPIClient Request Failed: ' . $this->errno . ' - ' . $this->err_str . "\ncurl_getinfo = " . print_r($this->curl_getinfo, true) . "\nrequest = " . print_r($this->request, true));
            //print 'Request Failed: ' . $this->errno . ' - ' . $this->err_str;
        } elseif ($this->curl_getinfo["http_code"] != 200) {
            trigger_error('SpectrumAPIClient HTTP Error: Response Code ' . $this->curl_getinfo["http_code"] . ': ' . print_r($this->curl_getinfo, true));
            DisplayErrMsg('SpectrumAPIClient HTTP Error: Response Code ' . $this->curl_getinfo["http_code"] . ': ' . print_r($this->curl_getinfo, true) . "\n" . print_r($this->request, true));
            //print 'HTTP Error: Response Code ' . $this->curl_getinfo["http_code"];
        } else {
            // Request must of been ok.
            $this->response = json_decode($this->RAWresponse);
            //trigger_error('response = ' . print_r($this->response, true) . "\ncurl_getinfo = " . print_r($this->curl_getinfo, true));
            //DisplayErrMsg('SpectrumAPIClient HTTP: response = ' . print_r($this->response, true) . "\ncurl_getinfo = " . print_r($this->curl_getinfo, true) . "\nrequest = " . print_r($this->request, true));
            return(True);
        }

        return false;

    }




}