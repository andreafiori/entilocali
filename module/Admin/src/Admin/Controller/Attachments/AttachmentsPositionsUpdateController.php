<?php

namespace Admin\Controller\Attachments;

use ModelModule\Model\Database\DbTableContainer;
use Application\Controller\SetupAbstractController;

class AttachmentsPositionsUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $items = $this->params()->fromQuery('oggettoItem');

        /**
         * @var \Doctrine\DBAL\Connection
         */
        $connection = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getConnection();

        if (!empty($items)):
            foreach ($items as $position => $item):
                $connection->update(
                    DbTableContainer::attachmentsOption,
                    array('position' => $position),
                    array('id' => $item)
                );
            endforeach;
        endif;

        $this->layout()->setTerminal(true);

        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'sezioni/positions_message.phtml');
    }
}