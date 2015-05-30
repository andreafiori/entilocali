<?php

namespace Admin\Controller\StatoCivile;

use ModelModule\Model\Database\DbTableContainer;
use Application\Controller\SetupAbstractController;

class StatoCivileOperationsController extends SetupAbstractController
{
    public function activeAction()
    {
        $id = $this->params()->fromRoute('id');

        if ($this->changeAttivo(1, $id)===true) {
            return $this->redirect()->toRoute('admin/stato-civile-summary', array('lang' => 'it'));
        }

        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setTemplate($mainLayout);
    }

    public function disableAction()
    {
        $id = $this->params()->fromRoute('id');

        if ($this->changeAttivo(0, $id)===true) {
            return $this->redirect()->toRoute('admin/stato-civile-summary', array('lang' => 'it'));
        }

        $mainLayout = $this->initializeAdminArea();

        $this->layout()->setTemplate($mainLayout);
    }

        /**
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
                $connection->update(DbTableContainer::statoCivileArticoli, array('attivo' => $attivo), array('id' => $id));

                $connection->commit();

                return true;
            } catch (\Exception $e) {
                $connection->rollBack();

                return $e;
            }
        }
}