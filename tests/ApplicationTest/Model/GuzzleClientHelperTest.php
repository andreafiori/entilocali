<?php

namespace ApplicationTest\Model;

use ApplicationTest\TestSuite;
use Application\Model\ClientHelper;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Exception\RequestException;
use Guzzle\Http\Exception\ServerErrorResponse;
use Guzzle\Http\Exception\BadResponseException;

/**
 * Guzzle Client Wrapper and Helper
 * 
 * @author Andrea Fiori
 * @since  19 April 2014
 */
class GuzzleClientHelper
{
    private $response;

    /**
     * Given the request, try to send it
     * Multiple Catch will take errors 400 or 500
     * Set the result on $this->response
     * 
     * @return array
     */
    public function sendResponse(\Guzzle\Http\Message\Request $request)
    {
        try {
            $this->response = $request->send($request);
            return $this->response;
	} catch (BadResponseException $e) {
            return $this->catchResponseError($e);
        } catch (ClientErrorResponseException $e) {
            return $this->catchResponseError($e);
	} catch (RequestException $e) {
            return $this->catchResponseError($e);
	} catch (ServerErrorResponse $e) {
            return $this->catchResponseError($e);
	}

        return $this->response;
    }

        /**
         * @param object $e
         * @return object
         */
        private function catchResponseError($e)
        {
            $this->response = $e->getResponse();

            return $this->response;
        }
    
    /**
     * @return type
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * TODO: check json format
     * 
     * @return array serialized JSON format or false
     */
    public function json()
    {
        $response = $this->getResponse();
        if ($response)
        {
            return $response->json();
        }
        
        return false;
    }
    
    /**
     * TODO: check response is xml
     * 
     * @return type
     */
    public function xml()
    {
        $response = $this->getResponse();
        if ($response)
        {
            return $response->xml();
        }
        
        return false;
    }
}

/**
 * ERROR 400 launch expectedException \Guzzle\Http\Exception\ClientErrorResponseException
 * ERROR 500 launch expectedException \Guzzle\Http\Exception\ServerErrorResponseException
 * 
 * @author Andrea Fiori
 * @since  19 April 2014
 */
class GuzzleClientHelperTest //extends TestSuite
{
    private $client;
    private $clientHelper;
    private $clientMock;

    protected function setUp()
    {
        $this->clientMock = new \Guzzle\Plugin\Mock\MockPlugin();
        
        $this->client = new \Guzzle\Http\Client();
        
        $this->clientHelper = new GuzzleClientHelper();
    }

    public function testSendResponse()
    {
        $request = $this->getHttpRequest();
 
        $this->assertTrue( is_object( $this->clientHelper->sendResponse($request) ) );
        $this->assertTrue( is_object($this->clientHelper->getResponse()) );
    }

    public function testJson()
    {
        $request = $request = $this->getHttpRequest();
        
        $this->clientHelper->sendResponse($request);

        $this->assertTrue( is_array( $this->clientHelper->json() ) );
    }
    
    public function testXml()
    {
        $request = $this->getHttpRequest();
        
        $this->clientHelper->sendResponse($request);
        
        $this->assertTrue( is_object( $this->clientHelper->xml() ) );
    }
    
        /**
         * Set request for this tests
         * 
         * @param number $number
         * @return \Guzzle\Http\Message\Request
         */
        private function getHttpRequest($number = 200)
        {
            $this->clientMock->addResponse(new \Guzzle\Http\Message\Response($number));

            $this->client->addSubscriber($this->clientMock);

            return $this->client->get("http://localhost/api/v1/setup");
        }
}