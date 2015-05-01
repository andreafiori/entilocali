<?php

namespace Admin\Controller\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Admin\Model\AlboPretorio\AlboPretorioOperationsControllerHelper;
use Application\Controller\SetupAbstractController;

/**
 * @author Andrea Fiori
 * @since  09 April 2015
 */
class AlboPretorioOperationsController extends SetupAbstractController
{
    /**
     * Pubblica atto albo
     *
     * @return string
     */
    public function publishAction()
    {
        if ($this->getServiceLocator()->get('request')->isPost()) {

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $userDetails = $this->recoverUserDetails();

            $helper = new AlboPretorioOperationsControllerHelper();
            $helper->setConnection($em->getConnection());
            $record = $helper->recoverSingleArticle(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                $this->params()->fromPost('publishId')
            );

            try {
                $helper->publishArticle($this->params()->fromPost('publishId'));

                $this->log(array(
                    'user_id'       => $userDetails->id,
                    'message'       => "Pubblicato atto albo pretorio " . $record[0]['titolo'],
                    'type'          => 'info',
                    'backend'       => 1,
                    'module_id'     => 3,
                    'reference_id'  => $record[0]['id'],
                ));
            } catch (\Exception $e) {
                $helper->getConnection()->rollBack();

                $this->log(array(
                    'user_id'       => $userDetails->id,
                    'message'       => "Errore pubblicazione atto albo pretorio " . $record[0]['titolo'] . ' Messaggio generato: ' . $e->getMessage(),
                    'type'          => 'error',
                    'backend'       => 1,
                    'module_id'     => 3,
                    'reference_id'  => $record[0]['id'],
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

            $helper = new AlboPretorioOperationsControllerHelper();
            $helper->setConnection($em->getConnection());
            $record = $helper->recoverSingleArticle(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                $id
            );

            try {

                $helper->annullArticle($id);

                $this->log(array(
                    'user_id'       => $userDetails->id,
                    'message'       => "Pubblicato atto albo pretorio " . $record[0]['titolo'],
                    'type'          => 'info',
                    'backend'       => 1,
                    'module_id'     => 3,
                    'reference_id'  => $record[0]['id'],
                ));

            } catch (\Exception $e) {
                $helper->getConnection()->rollBack();

                $this->log(array(
                    'user_id'       => $userDetails->id,
                    'message'       => "Errore pubblicazione atto albo pretorio " . $record[0]['titolo'] . ' Messaggio generato: ' . $e->getMessage(),
                    'type'          => 'error',
                    'backend'       => 1,
                    'module_id'     => 3,
                    'reference_id'  => $record[0]['id'],
                ));

                // TODO: redidrect to a message page and show an error message
            }

            return $this->redirectToSummary();
        }

        return $this->redirectToSummary();
    }

        private function redirectToSummary()
        {
            return $this->redirect()->toRoute('admin/albo-pretorio-summary', array('lang' => 'it'));
        }
}