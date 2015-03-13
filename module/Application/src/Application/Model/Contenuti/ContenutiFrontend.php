<?php

namespace Application\Model\Contenuti;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Zend\Http\Response;

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
            $wrapper->setEntityManager($this->getInput('entityManager', 1));
            $wrapper->setInput(array(
                    'noscaduti'     => 1,
                    'attivo'        => 1,
                    'modulo'        => 2,
                    'sottosezione'  => $param['route']['subsectionid'],
                    'entityManager' => $this->getInput('entityManager', 1)
                )
            );
            $wrapper->setupQueryBuilder();

            $records = $wrapper->addAttachmentsFromRecords(
                $wrapper->getRecords(),
                array(
                    'moduleId'    => 2,
                    'noscaduti'   => 1,
                )
            );
        }

        $this->setVariables(array(
            'records'       => isset($records) ? $records : null,
            'recordsCount'  => count($records),
        ));

        $this->setTemplate('contenuti/node.phtml');
    }
}