<?php

namespace Admin\Controller\Sezioni;

use Application\Controller\SetupAbstractController;

class SezioniOperationsController extends SetupAbstractController
{
    public function disableAction()
    {
        $id = $this->params()->fromRoute('id');
    }

    public function enableAction()
    {
        $id = $this->params()->fromRoute('id');
    }

    /**
     * Switch language on summary
     *
     * @return \Zend\Http\Response
     */
    public function changesummarylangAction()
    {
        if ($this->getRequest()->isPost()) {
            return $this->redirect()->toRoute('admin/sezioni-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromPost('lingua'),
                'modulename'        => $this->params()->fromRoute('modulename'),
                'page'              => $this->params()->fromRoute('page'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }

    public function changepositionslangAction()
    {
        if ($this->getRequest()->isPost()) {
            return $this->redirect()->toRoute('admin/sezioni-positions', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromPost('lingua'),
                'modulename'        => $this->params()->fromRoute('modulename'),
                'page'              => $this->params()->fromRoute('page'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }
}