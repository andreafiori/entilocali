<?php

namespace Application\Controller\SearchEngine;

use ModelModule\Model\SearchEngine\SearchEngineFormInputFilter;
use ModelModule\Model\SearchEngine\SearchEngineForm;

/**
 * Search Engine Controller on public website
 */
class SearchEngineController extends SearchEngineAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->redirect()->toRoute('main');
        }

        $post = $request->getPost()->toArray();

        $inputFilter = new SearchEngineFormInputFilter();

        $formSearch = new SearchEngineForm();
        $formSearch->setInputFilter($inputFilter->getInputFilter());
        $formSearch->setData($post);

        if ( $formSearch->isValid() ) {

            $helper = $this->recoverSearchRecords($post, 1, null);

            $this->layout()->setVariables(array(
                'records'           => $helper->getSearchRecords(),
                'templatePartial'   => 'search-engine/search-engine.phtml',
            ));

        } else {

            $this->layout()->setVariables(array(
                'messageType'       => 'info',
                'moduleLabel'       => 'Ricerca',
                'messageTitle'      => 'Richiesta non valida',
                'messageText'       => 'La richiesta effettuata non &egrave; considerata valida, riprovare',
                'templatePartial'   => 'message.phtml',
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }
}