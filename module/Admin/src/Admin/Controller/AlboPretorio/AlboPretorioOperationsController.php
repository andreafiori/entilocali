<?php

namespace Admin\Controller\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\Database\DbTableContainer;

/**
 * @author Andrea Fiori
 * @since  09 April 2015
 */
class AlboPretorioOperationsController extends SetupAbstractController
{
    /**
     * Annull atto and redirect to summary
     */
    public function annullAction()
    {
        if ($this->getServiceLocator()->get('request')->isPost()) {

        }

        return $this->redirect()->toRoute('admin',  array('lang' => 'it') );
    }

    public function publishAction()
    {
        if ($this->getServiceLocator()->get('request')->isPost()) {

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $record = $this->recoverArticle($em, $this->params()->fromPost('publishId'));

            $userDetails = $this->recoverUserDetails();

            $connection = $em->getConnection();
            $connection->beginTransaction();
            try {
                $connection->update(
                    DbTableContainer::alboArticoli,

                    array(
                        'pubblicare' => 1,
                        'attivo'     => 1,
                        'annullato'  => 0,
                    ),

                    array('id' => $this->params()->fromPost('publishId') )
                );

                $this->log(
                    array(
                        'user_id'       => $userDetails->id,
                        'module_id'     => 2,
                        'message'       => "Annullato atto albo pretorio ".$record[0]['titolo'],
                        'type'          => 'error',
                        'backend'       => 1,
                        'reference_id'  => $record[0]['id']
                    )
                );

                $connection->commit();

                return $this->redirect()->toRoute('admin/albo-pretorio-summary',  array('lang' => 'it') );

            } catch (\Exception $e) {
                $connection->rollBack();

                $this->log(array(
                    'user_id'   => $userDetails->id,
                    'module_id' => 2,
                    'message'   => "Errore annullamento atto albo pretorio ".$record[0]['titolo'].' ID: '.$record[0]['id'],
                    'type'      => 'error',
                    'backend'   => 1,
                ));

                return $e->getMessage();
            }
        }

        return $this->redirect()->toRoute('admin',  array('lang' => 'it') );
    }

        /**
         * @param int $id
         * @return AlboPretorioArticoliGetterWrapper
         */
        private function recoverArticle($em, $id)
        {
            $wrapper = new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter($em) );
            $wrapper->setInput(
                array(
                    'id'    => $id,
                    'limit' => 1,
                )
            );
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
}