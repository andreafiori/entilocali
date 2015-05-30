<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;

class SezioniPositionsUpdateController extends SetupAbstractController
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
                    DbTableContainer::sezioni,
                    array('posizione' => $position),
                    array('id' => $item)
                );
            endforeach;
        endif;

        $this->layout()->setTerminal(true);
        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'sezioni/positions_message.phtml');
    }
}