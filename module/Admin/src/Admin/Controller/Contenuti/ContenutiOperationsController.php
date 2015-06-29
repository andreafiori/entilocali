<?php

namespace Admin\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiFormSearch;
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
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
                'page'              => $this->params()->fromRoute('page'),
                'modulename'        => $this->params()->fromRoute('modulename'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }

    /**
     * TODO: delete this, use the common controller to post search both from frontend and admin area (same form)
     *
     * Set session search for the summary
     */
    public function summarysearchAction()
    {
        if ($this->getRequest()->isPost()) {

            $formSearch = new ContenutiFormSearch();
            $formSearch->addAnno();
            $formSearch->addInHome();
            $formSearch->addCheckExpired();

            $sessionContainer = new SessionContainer();
            $sessionContainer->offsetSet('contenutiSummarySearch', array(
                'testo'         => $this->params()->fromPost('testo'),
                'sottosezioni'  => $this->params()->fromPost('sottosezioni'),
                'inhome'        => $this->params()->fromPost('inhome'),
            ));

            return $this->redirect()->toRoute('admin/contenuti-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
                'modulename'        => $this->params()->fromRoute('modulename'),
                'page'              => $this->params()->fromRoute('page'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }
}