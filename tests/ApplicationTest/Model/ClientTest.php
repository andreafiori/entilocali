<?php

use Zend\Http\Response;
use Zend\Stdlib\Parameters;
use Zend\Http\Client as HttpClient;
use Zend\Http\Request;


class HttpRestJsonClient
{
    protected $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function get($url)
    {
        return $this->dispatchRequestAndDecodeResponse($url, "GET");
    }

    public function post($url, $data)
    {
        return $this->dispatchRequestAndDecodeResponse($url, "POST", $data);
    }

    public function put($url, $data)
    {
        return $this->dispatchRequestAndDecodeResponse($url, "PUT", $data);
    }

    public function delete($url)
    {
        return $this->dispatchRequestAndDecodeResponse($url, "DELETE");
    }

    /**
     * TODO: should interogate response status, throwing appropiate exceptions for error codes
     * 
     * @param string $url
     * @param string $method
     * @param string $data
     */
    protected function dispatchRequestAndDecodeResponse($url, $method, $data = null)
    {
        $request = new Request();
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        $request->setUri($url);
        $request->setMethod($method);

        if ($data){
            $request->setPost(new Parameters($data));
        }

        $response = $this->httpClient->dispatch($request);

        return json_decode($response->getBody(), true);
        //return $response->getBody();
    }
}


class ClientTest extends ApplicationTest\TestSuite
{
    public function testGetReturnsAssociativeArrayContent()
    {
        $url = "http://api/test";
        $method = "GET";
        $responseContent = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

        $mockHttpClient = $this->getMockForSuccessfulHttpClientDispatch($url, $method, $responseContent);

        $httpRestJsonClient = new HttpRestJsonClient($mockHttpClient);

        $this->assertSame(
            json_decode($responseContent, true),
            $httpRestJsonClient->get($url)
        );
    }

    public function testPostReturnsAssociativeArrayContent()
    {
        $url = "http://api/test";
        $method = "POST";
        $responseContent = '{"id":1}';
        $data = array("active" => true, "val" => "test");

        $mockHttpClient = $this->getMockForSuccessfulHttpClientDispatch(
            $url,
            $method,
            $responseContent,
            $data
        );

        $httpRestJsonClient = new HttpRestJsonClient($mockHttpClient);

        $this->assertSame(
            json_decode($responseContent, true),
            $httpRestJsonClient->post($url, $data)
        );
    }

    public function testPutReturnsAssociativeArrayContent()
    {
        $url = "http://api/test";
        $method = "PUT";
        $responseContent = '{"id":1,"active":true,"val":"test"}';
        $data = array("id" => 1, "active" => true, "val" => "test");

        $mockHttpClient = $this->getMockForSuccessfulHttpClientDispatch(
            $url,
            $method,
            $responseContent,
            $data
        );

        $httpRestJsonClient = new HttpRestJsonClient($mockHttpClient);

        $this->assertSame(
            json_decode($responseContent, true),
            $httpRestJsonClient->put($url, $data)
        );
    }

    public function testDeleteReturnsAssociativeArrayContent()
    {
        $url = "http://api/test/1";
        $method = "DELETE";
        $responseContent = '{"data":"id 1 has been deleted"}';

        $mockHttpClient = $this->getMockForSuccessfulHttpClientDispatch($url, $method, $responseContent);

        $httpRestJsonClient = new HttpRestJsonClient($mockHttpClient);

        $this->assertSame(
            json_decode($responseContent, true),
            $httpRestJsonClient->delete($url)
        );
    }

    protected function getMockForSuccessfulHttpClientDispatch($url, $method, $responseContent, $postData = null)
    {
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->setContent($responseContent);

        $mockHttpClient = $this->getMock('Zend\Http\Client', array('dispatch'));
        $mockHttpClient->expects($this->once())
                        ->method('dispatch')
                        ->will($this->returnCallback(function($request) use ($response, $method, $url, $postData) {
                            PHPUnit_Framework_Assert::assertSame($request->getMethod(), $method);
                            PHPUnit_Framework_Assert::assertSame($request->getUriString(), $url);

                            if ($postData) {
                                PHPUnit_Framework_Assert::assertSame($request->getPost()->getArrayCopy(), $postData);
                            }
                            return $response;
                        }));

        return $mockHttpClient;
    }
}