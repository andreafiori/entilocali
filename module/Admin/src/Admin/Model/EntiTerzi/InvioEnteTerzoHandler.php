<?php

namespace Admin\Model\Entiterzi;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\StatoCivile\StatoCivileRecordsGetter;

/**
 * Form invio enti terzi
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
                
        $moduleMap = array(
            'albo-pretorio'         => '',
            'atti-ufficiali'        => '',
            'stato-civile'          => '',
            'contratti-pubblici'    => '',
            'determine'             => '',
        );
        
        $entiTerziRecords = $this->getRubricaEntiTerzi(new EntiTerziGetterWrapper(new EntiTerziGetter($this->getInput('entityManager', 1))));
        
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
        private function getRubricaEntiTerzi(EntiTerziGetterWrapper $entiTerziGetterWrapper)
        {
            $entiTerziGetterWrapper->setupQueryBuilder();
            
            return $entiTerziGetterWrapper->getRecords();
        }
}
