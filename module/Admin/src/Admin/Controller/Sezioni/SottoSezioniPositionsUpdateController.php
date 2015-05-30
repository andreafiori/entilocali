<?php

namespace Admin\Controller\Sezioni;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;

class SottoSezioniPositionsUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $items = $this->params()->fromQuery('oggettoItem');

        $connection = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getConnection();

        if (!empty($items)):
            foreach ($items as $position => $item):
                $connection->update(
                    DbTableContainer::sottosezioni,
                    array('posizione' => $position),
                    array('id'        => $item)
                );
            endforeach;
        endif;

        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'sezioni/sottosezioni/positions_message.phtml');
    }
}