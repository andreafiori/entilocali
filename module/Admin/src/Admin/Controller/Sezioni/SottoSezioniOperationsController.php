<?php

namespace Admin\Controller\Sezioni;

use Application\Controller\SetupAbstractController;

class SottoSezioniOperationsController extends SetupAbstractController
{
    /**
     * Switch language on summary
     *
     * @return \Zend\Http\Response
     */
    public function changecontenutisummarylangAction()
    {
        if ($this->getRequest()->isPost()) {
            return $this->redirect()->toRoute('admin/sottosezioni-contenuti-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromPost('lingua'),
                'page'              => $this->params()->fromRoute('page'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }

    /**
     * @return \Zend\Http\Response
     */
    public function changeammtraspsummarylangAction()
    {
        if ($this->getRequest()->isPost()) {
            return $this->redirect()->toRoute('admin/sottosezioni-amm-trasp-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromPost('lingua'),
                'page'              => $this->params()->fromRoute('page'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }
}