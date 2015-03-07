<?php

namespace Application\Model\Contenuti;

use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;
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
            $wrapper->setInput(array(
                //'noscaduti' => 1,
                'attivo'    => 1,
                'modulo'    => 2,
                'sottosezione' => $param['route']['subsectionid'])
            );
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
            $recordsCount = count($records);

            /* Attachment Files */
            if (!empty($records)) {
                foreach($records as &$record) {
                    $attachments = new AttachmentsGetterWrapper( new AttachmentsGetter($this->getInput('entityManager', 1)) );
                    $attachments->setInput(array(
                            'referenceId' => $record['id'],
                            'moduleId'    => 2,
                            'limit'       => 4
                        )
                    );
                    $attachments->setupQueryBuilder();

                    $attachmentsRecords = $attachments->getRecords();

                    if (!empty($attachmentsRecords)) {
                        $record['attachments'] = $attachmentsRecords;
                    }
                }
            }
        }

        $this->setTemplate('contenuti/node.phtml');

        $this->setVariables(array(
            'records'       => isset($records) ? $records : null,
            'recordsCount'  => $recordsCount,
        ));
    }
}
