<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Modules\ModulesContainer;

/**
 * Albo Pretorio Operations Controller
 */
class AlboPretorioOperationsController extends SetupAbstractController
{
    public function activeAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        $userDetails = $this->recoverUserDetails();

        $helper = new AlboPretorioControllerHelper();
        $helper->setConnection($em->getConnection());
        $helper->getConnection()->beginTransaction();

        try {
            $alboRecord = $helper->recoverWrapperRecordsById(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                array('id' => $id, 'limit' => 1),
                $id
            );
            $helper->checkRecords($alboRecord, "Dati relativi all'atto non trovati");
            $helper->activeAtto($id);

            $helper->getConnection()->commit();

            $this->log(array(
                'user_id'       => $userDetails->id,
                'message'       => "Attivato atto albo pretorio ".$alboRecord[0]['titolo'],
                'type'          => 'info',
                'backend'       => 1,
                'module_id'     => ModulesContainer::albo_pretorio_id,
                'reference_id'  => $alboRecord[0]['id'],
            ));

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }

        } catch (\Exception $e) {
            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $exDb) {

            }

            $this->log(array(
                'user_id'       => $userDetails->id,
                'message'       => "Errore attivazione atto albo pretorio ".$alboRecord[0]['titolo'].' Messaggio generato: '.$e->getMessage(),
                'type'          => 'error',
                'backend'       => 1,
                'module_id'     => ModulesContainer::albo_pretorio_id,
                'reference_id'  => $alboRecord[0]['id'],
            ));
        }
    }

    /**
     * Pubblish atto albo: TODO: update pubblicare to 1, assign progressivo number
     *
     * @return string
     */
    public function publishAction()
    {
        if ($this->getServiceLocator()->get('request')->isPost()) {

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $userDetails = $this->recoverUserDetails();

            $id = $this->params()->fromPost('publishId');

            $helper = new AlboPretorioControllerHelper();
            $helper->setConnection($em->getConnection());
            $helper->getConnection()->beginTransaction();

            try {

                $attoRecord = $helper->recoverWrapperRecordsById(
                    new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                    array('id' => $id, 'limit' => 1),
                    $id
                );
                $helper->checkRecords($attoRecord, 'Dati atto non trovati');

                $numeroProgressivo = $helper->recoverNumeroProgressivo(
                    new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                    $attoRecord[0]['anno']
                );

                $helper->publishArticle($id, $numeroProgressivo);

                $helper->getConnection()->commit();

                $this->log(array(
                    'user_id'       => $userDetails->id,
                    'message'       => "Pubblicato atto albo pretorio ".$attoRecord[0]['titolo'],
                    'type'          => 'info',
                    'backend'       => 1,
                    'module_id'     => ModulesContainer::albo_pretorio_id,
                    'reference_id'  => $attoRecord[0]['id'],
                ));

            } catch (\Exception $e) {

                try {
                    $helper->getConnection()->rollBack();
                } catch(\Doctrine\DBAL\ConnectionException $exDb) {

                }

                $this->log(array(
                    'user_id'       => $userDetails->id,
                    'message'       => "Errore pubblicazione atto albo pretorio ".$attoRecord[0]['titolo'].' Messaggio generato: '.$e->getMessage(),
                    'type'          => 'error',
                    'backend'       => 1,
                    'module_id'     => ModulesContainer::albo_pretorio_id,
                    'reference_id'  => $attoRecord[0]['id'],
                ));

                // TODO: redirect to a message page and show an error message
            }
        }

        return $this->redirectToSummary();
    }

    /**
     * Annull atto and redirect to summary
     */
    public function annullAction()
    {
        if ($this->getServiceLocator()->get('request')->isPost()) {

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $userDetails = $this->recoverUserDetails();

            $id = $this->params()->fromPost('annullId');

            $helper = new AlboPretorioControllerHelper();
            $helper->setConnection($em->getConnection());
            $helper->getConnection()->beginTransaction();

            try {

                $record = $helper->recoverWrapperRecordsById(
                    new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                    array('id' => $id, 'limit' => 1),
                    $id
                );

                $helper->annullArticle($id);

                $helper->getConnection()->commit();

                $this->log(array(
                    'user_id'       => $userDetails->id,
                    'message'       => "Pubblicato atto albo pretorio " . $record[0]['titolo'],
                    'type'          => 'info',
                    'backend'       => 1,
                    'module_id'     => ModulesContainer::albo_pretorio_id,
                    'reference_id'  => $record[0]['id'],
                ));

            } catch (\Exception $e) {

                try {
                    $helper->getConnection()->rollBack();
                } catch(\Doctrine\DBAL\ConnectionException $exDb) {

                }

                $this->log(array(
                    'user_id'       => $userDetails->id,
                    'message'       => "Errore pubblicazione atto albo pretorio " . $record[0]['titolo'] . ' Messaggio generato: ' . $e->getMessage(),
                    'type'          => 'error',
                    'backend'       => 1,
                    'module_id'     => ModulesContainer::albo_pretorio_id,
                    'reference_id'  => $record[0]['id'],
                ));

                // TODO: redirect to a message page and show an error message
            }

        }

        return $this->redirectToSummary();
    }

    /**
     * @return Redirect
     */
    private function redirectToSummary()
    {
        return $this->redirect()->toRoute('admin/albo-pretorio-summary', array('lang' => 'it'));
    }
}