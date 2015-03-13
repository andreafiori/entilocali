<?php

namespace Admin\Model\EntiTerzi;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\StatoCivile\StatoCivileRecordsGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  30 July 2014
 */
class InvioEnteTerzoHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param      = $this->getInput('param', 1);

        $moduleName = $param['route']['modulename'];
        
        switch($moduleName) {
            default:
                // error
            break;
            
            case("albo-pretorio"):
                $recordsGetter = new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter( $this->getInput('entityManager',1) ));
                $recordsGetter->setInput( array('id' => $param['route']['id'], 'limit' => 1) );
                $recordsGetter->setupQueryBuilder();
                
                $record = $recordsGetter->getRecords();
                $titolo = $record[0]['titolo'];
            break;
        
            case("stato-civile"):
                $recordsGetter = new StatoCivileRecordsGetter( $this->getInput() );
                $recordsGetter->setArticoli( array("id" => $param['route']['id'], 'limit' => 1) );
                
                $record = $recordsGetter->getRecords();
                $titolo = $record[0]['titolo'];
            break;
        
            case("contratti-pubblici"):
                
            break;
        
            case("amministrazione-trasparente"):
                
            break;
        }

        $wrapper = new EntiTerziGetterWrapper(new EntiTerziGetter($this->getInput('entityManager', 1)));
        $wrapper->setupQueryBuilder();
        $entiTerziRecords = $wrapper->getRecords();
        
        $form = new InvioEnteTerzoForm();
        $form->addContatti($entiTerziRecords);

        $this->setVariables(array(
            'formDataCommonPath' => 'backend/templates/common/',
            'form'               => $form,
            'titolo'             => $titolo,
            'rubricaEntiTerzi'   => $entiTerziRecords,
        ));
        
        $this->setTemplate('invio-ente-terzo/invio-ente-terzo.phtml');
        
        return $this->getOutput();
    }
}
