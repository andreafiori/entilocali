<?php

namespace Admin\Model\Entiterzi;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\StatoCivile\StatoCivileRecordsGetter;
use Admin\Model\Amazon\S3\S3;
use Application\Model\NullException;

/**
 * TODO: given the module name, get relative record with title
 *       show hide radio button with
 * 
 * @author Andrea Fiori
 * @since  30 July 2014
 */
class InvioEnteTerzoHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param      = $this->getInput('param', 1);
        $moduleName = $param['route']['modulename'];
        
        $statoCivileRecordsGetter = new StatoCivileRecordsGetter( $this->getInput() );
        $statoCivileRecordsGetter->setArticoli(array("id" => $param['route']['id']));
        $record = $statoCivileRecordsGetter->getRecords();
        
        /*
        // echo file_exists('public/frontend/prova.txt');
        set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
            // error was suppressed with the @-operator
            if (0 === error_reporting()) {
                return false;
            }

            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        
        try {
            $s3 = new S3('AKIAJ2Z3KZLRTMJ3E6LA', '5H6jvvlQg2C06yTPdVOiqWOQDxBdehHZgvIz+ft2ASD');
            //$s3->putObject(S3::inputFile('public/frontend/prova.txt', false), 'kronoweb', 'prova.txt', S3::ACL_PUBLIC_READ);
            // echo $s3->putObject('this is the string i want to write on the file...', 'kronoweb', 'prova.txt', S3::ACL_PUBLIC_READ, array(), array('Content-Type' => 'text/plain'));
            //$s3->getObject('kronoweb', 'prova.txt');
        } catch (\ErrorException $e) {
            echo $e->getMessage();
        }
        */
        
        $moduleMap = array(
            'albo-pretorio'         => '',
            'atti-ufficiali'        => '',
            'stato-civile'          => '',
            'contratti-pubblici'    => '',
            'determine'             => '',
        );
        
        $entiTerziRecords = $this->getRubricaEntiTerzi();
        
        $form = new InvioEnteTerzoForm();
        $form->addContatti($entiTerziRecords);
        //$form->setData($moduleMap);

        $this->setVariables(array(
            'formDataCommonPath' => 'backend/templates/common/',
            'form'               => $form,
            'titolo'             => '',
            'rubricaEntiTerzi'   => $entiTerziRecords,
        ));
        
        $this->setTemplate('invio-ente-terzo/invio-ente-terzo.phtml');
        
        return $this->getOutput();
    }
    
        /**
         * Get rubrica enti terzi records 
         * 
         * @return EntiTerziGetterWrapper
         */
        private function getRubricaEntiTerzi()
        {
            $entiTerziGetterWrapper = new EntiTerziGetterWrapper( new EntiTerziGetter($this->getInput('entityManager', 1)) );
            $entiTerziGetterWrapper->setupQueryBuilder();
            return $entiTerziGetterWrapper->getRecords();
        }
}
