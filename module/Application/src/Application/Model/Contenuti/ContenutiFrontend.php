<?php

namespace Application\Model\Contenuti;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  19 January 2015
 */
class ContenutiFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);
        
        if (isset($param['route']['subsectionid'])) {
            $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($this->getInput('entityManager', 1)) );
            $wrapper->setInput(array(
                'noscaduti' => 1,
                'attivo' => 1,
                'modulo' => 2,
                'sottosezione' => $param['route']['subsectionid'])
            );
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
            $recordsCount = count($records);
            
            $wrapperSottoSezioni = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager', 1)) );
            $wrapperSottoSezioni->setInput(array('modulo' => 2));
            $wrapperSottoSezioni->setupQueryBuilder();
        }
        
        $this->setTemplate('contenuti/node.phtml');
        $this->setVariables(array(
            'records'  => isset($records) ? $records : null,
            'recordsCount' => $recordsCount,
            'sections' => '',
        ));
    }
}
