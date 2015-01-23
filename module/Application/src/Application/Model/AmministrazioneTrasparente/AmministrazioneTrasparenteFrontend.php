<?php

namespace Application\Model\AmministrazioneTrasparente;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class AmministrazioneTrasparenteFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);
        $config = $this->getInput('configurations', 1);
        
        $formSearch = new AmministrazioneTrasparenteFormSearch();
        $formSearch->setData(array('anno'=>date("Y")));
        
        $sottoSezioni = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager', 1)) );
        $sottoSezioni->setInput(array('attivo' => 1, 'modulo' => 2));
        $sottoSezioni->setupQueryBuilder();
        
        $this->setTemplate('amministrazione-trasparente/amministrazione-trasparente.phtml');
        $this->setVariables(array(
            'form'                       => $formSearch,
            'basiclayout'                => isset($config['amministrazione_trasparente_basiclayout']) ? $config['amministrazione_trasparente_basiclayout'] : null
        ));
        
        return $this->getOutput();
    }
    
    /**
     * 
     * @param int $id
     * @return array
     */
    private function getContent($id)
    {
        $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput( array('orderBy' => 'contenuti.id DESC', 'limit' => 1) );
        $wrapper->setupQueryBuilder();
        
        return $wrapper->getRecords();
    }
}
