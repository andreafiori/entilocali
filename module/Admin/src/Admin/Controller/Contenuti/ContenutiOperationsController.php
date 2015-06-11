<?php

namespace Admin\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiOperationsModel;
use Application\Controller\SetupAbstractController;
use Zend\Session\Container as SessionContainer;

class ContenutiOperationsController extends SetupAbstractController
{
    /**
     * Switch language on summary
     *
     * @return \Zend\Http\Response
     */
    public function changesummarylangAction()
    {
        if ($this->getRequest()->isPost()) {
            return $this->redirect()->toRoute('admin/contenuti-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromPost('lingua'),
                'page'              => $this->params()->fromRoute('page'),
                'modulename'        => $this->params()->fromRoute('modulename'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }

    /**
     * Set session search for the summary
     */
    public function summarysearchAction()
    {
        if ($this->getRequest()->isPost()) {

            $sessioContainer = new SessionContainer();
            $sessioContainer->offsetSet('contenutiSummarySearch', array(
                'testo'         => '',
                'sottosezioni'  => '',
                'inhome'        => '',
            ));

            return $this->redirect()->toRoute('admin/contenuti-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromPost('lingua'),
                'modulename'        => $this->params()->fromRoute('modulename'),
                'page'              => $this->params()->fromRoute('page'),
            ));
        }

        return $this->redirect()->toRoute('main');
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
    }
}