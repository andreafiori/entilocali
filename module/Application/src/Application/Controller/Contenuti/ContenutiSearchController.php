<?php

namespace Application\Controller\Contenuti;

class ContenutiSearchController
{
    /**
     * Set session search for the summary
     *
     * @return mixed
     */
    public function indexAction()
    {
        if ($this->getRequest()->isPost()) {

            $formSearch = new ContenutiFormSearch();
            $formSearch->addAnno();
            $formSearch->addInHome();
            $formSearch->addCheckExpired();

            $sessioContainer = new SessionContainer();
            $sessioContainer->offsetSet('contenutiSummarySearch', array(
                'testo'         => $this->params()->fromPost('testo'),
                'sottosezioni'  => $this->params()->fromPost('sottosezioni'),
                'inhome'        => $this->params()->fromPost('inhome'),
            ));

            /* TODO: redirect to previouse page
            return $this->redirect()->toRoute('admin/contenuti-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
                'modulename'        => $this->params()->fromRoute('modulename'),
                'page'              => $this->params()->fromRoute('page'),
            ));
            */
        }

        return $this->redirect()->toRoute('main');
    }
}