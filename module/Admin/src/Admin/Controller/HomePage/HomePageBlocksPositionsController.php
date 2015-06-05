<?php

namespace Admin\Controller\HomePage;

use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModule\Model\HomePage\HomePageControllerHelper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;

class HomePageBlocksPositionsController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {

            $helper = new HomePageControllerHelper();
            $homePageRecords =  $helper->recoverWrapperRecords(
                new HomePageBlocksGetterWrapper(new HomePageBlocksGetter($em)),
                array(
                    'orderBy' => 'homePageBlocks.position',
                    'fields'  => ''
                )
            );
            $helper->checkRecords($homePageRecords, 'Nessun blocco home page presente');

            $this->layout()->setVariables(array(
                'records'           => $homePageRecords,
                'templatePartial'   => 'homepage/homepage-blocks-positions.phtml',
            ));

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore verificato',
                'messageText'           => $e->getMessage(),
                'showBreadCrumb'        => 1,
                'formBreadCrumbCategory' => array(
                    array(
                        'label' => 'Gestione home page',
                        'href' => '#',
                        'title' => 'Vai alla gestione home page',
                    ),
                ),
                'dataTableActiveTitle'  => 'Posizioni moduli',
                'templatePartial'       => 'message.phtml'
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Update positions: this action is called via AJAX
     */
    public function updateAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $items = $this->params()->fromQuery('oggettoItem');

        $connection = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getConnection();

        if (!empty($items)):
            foreach ($items as $position => $item):
                $connection->update(
                    DbTableContainer::homepageBlocks,
                    array('position' => $position),
                    array('id' => $item)
                );

            endforeach;
        endif;

        $this->layout()->setTerminal(true);

        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'sezioni/positions_message.phtml');
    }
}