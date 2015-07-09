<?php

namespace Admin\Controller\Contenuti;

use Application\Controller\Contenuti\ContenutiSearchController;
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
            $languageSelection = $this->params()->fromPost('lingua');
            return $this->redirect()->toRoute('admin/contenuti-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $languageSelection ? $languageSelection : 'it',
                'page'              => $this->params()->fromRoute('page'),
                'modulename'        => $this->params()->fromRoute('modulename'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }

    /**
     * TODO: delete this method, use ContenutiSearchController
     * Set session search for the summary
     *
     * @return mixed
     */
    public function summarysearchAction()
    {
        if ($this->getRequest()->isPost()) {

            $formSearch = new ContenutiFormSearch();
            $formSearch->addAnno();
            $formSearch->addInHome();
            $formSearch->addCheckExpired();

            $sessioContainer = new SessionContainer();
            $sessioContainer->offsetSet(ContenutiSearchController::sessionIdentifier, array(
                'testo'         => $this->params()->fromPost('testo'),
                'sottosezioni'  => $this->params()->fromPost('sottosezioni'),
                'inhome'        => $this->params()->fromPost('inhome'),
            ));

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }
        }

        return $this->redirect()->toRoute('main');
    }
}