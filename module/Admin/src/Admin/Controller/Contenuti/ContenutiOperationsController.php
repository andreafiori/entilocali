<?php

namespace Admin\Controller\Contenuti;

use Admin\Model\Contenuti\ContenutiForm;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Contenuti\ContenutiOperationsModel;
use Admin\Model\Log\LogWriter;
use Admin\Model\Modules\ModulesContainer;
use Application\Controller\SetupAbstractController;

class ContenutiOperationsController extends SetupAbstractController
{
    public function insertAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->layout()->getVariable('userDetails');

        $form = new ContenutiForm();

        $this->layout()->setTemplate($mainLayout);
    }

    public function updateAction()
    {

    }

    /**
     * TODO: delete from contenuti, delete attachments (if...): attachments, options, relation, file from AWS...
     */
    public function deleteAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromPost('id');

        $operationModel = new ContenutiOperationsModel();

        if (empty($id)) {
            return $this->redirect()->toRoute('admin', array('lang'=>'it'));
        }

        echo "here"; exit;
    }
}