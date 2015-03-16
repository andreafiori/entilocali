<?php

namespace ApiWebService\Model;

use Zend\Http\Response;
use Zend\View\Model\JsonModel;

/**
 * @author Andrea Fiori
 * @since  16 September 2014
 */
class ApiOutputManager
{
    protected $outputFormat;
    
    protected $statusCode;
    
    /**
     * @param string $outputFormat
     */
    public function __construct($outputFormat)
    {
        $this->outputFormat = $outputFormat;
        
        $this->statusCode = Response::STATUS_CODE_200;
    }
    
    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        
        return $this->statusCode;
    }
    
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getOutputFormat()
    {
        return $this->outputFormat;
    }

    /**
     * Get the output with given format
     * 
     * @param array $content
     * @return \Zend\View\Model\JsonModel|\Zend\Http\Response
     */
    public function setupOutput(array $content)
    {
        switch($this->outputFormat)
        {
            case("json"):
                if ( $this->getStatusCode() != 200) {
                    $jsonModel = new JsonModel($content);
                    return $jsonModel;
                }
            break;

            case("xml"): case("rdf"):
                $response = new Response();
                $response->setStatusCode($this->getStatusCode());
                $response->getHeaders()->addHeaderLine('Content-Type', 'text/xml; charset=utf-8');
                $response->setContent($this->array2xml($content));

                return $response;
        }

        return false;
    }
    
        /**
         * Convert array into xml using recursion
         * 
         * @param $array $array
         * @param $xml
         * @return \SimpleXMLElement
         */
        private function array2xml(array $array, $xml = false)
        {
            if ($xml === false) {
                $xml = new \SimpleXMLElement('<root/>');
            }

            foreach($array as $key => $value) {
                if (is_array($value)) {
                    $this->array2xml($value, $xml->addChild('element'));
                } else {
                    $xml->addChild($key, htmlspecialchars($value));
                }
            }

            return $xml->asXML();
        }
}