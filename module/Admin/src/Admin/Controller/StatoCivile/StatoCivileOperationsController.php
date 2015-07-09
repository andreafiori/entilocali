<?php

namespace Admin\Controller\StatoCivile;

use ModelModule\Model\Database\DbTableContainer;
use Application\Controller\SetupAbstractController;

/**
 * Stato Civile additional Operations Controller
 */
class StatoCivileOperationsController extends SetupAbstractController
{
    /**
     * Enable atto and redirect to summary
     *
     * @return \Zend\Http\Response
     */
    public function activeAction()
    {
        $lang = $this->params()->fromRoute('lang');
        $id = $this->params()->fromRoute('id');

        if ($this->changeAttivo(1, $id)===true) {
            return $this->redirect()->toRoute('admin/stato-civile-summary', array('lang' => $lang));
        }

        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Disable atto and redirect to summary
     *
     * @return \Zend\Http\Response
     */
    public function disableAction()
    {
        $lang = $this->params()->fromRoute('lang');
        $id = $this->params()->fromRoute('id');

        if ($this->changeAttivo(0, $id)===true) {
            return $this->redirect()->toRoute('admin/stato-civile-summary', array('lang' => $lang));
        }

        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * TODO: move this method into the controller helper!
         *
         * @param int $attivo
         * @param int $id
         *
         * @return mixed
         */
        private function changeAttivo($attivo, $id)
        {
            $connection = $this->recoverConnection();
            $connection->beginTransaction();
            try {
                $connection->update(
                    DbTableContainer::statoCivileArticoli,
                    array('attivo' => $attivo),
                    array('id' => $id)
                );

                $connection->commit();

                return true;
            } catch (\Exception $e) {
                $connection->rollBack();

                return $e;
            }
        }
}