<?php

namespace Application\Controller\StatoCivile;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use ModelModule\Model\StatoCivile\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;

class StatoCivileController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        try {

            $helper = new StatoCivileControllerHelper();
            $helper->setStatoCivileSezioniGetterWrapper(
                new StatoCivileSezioniGetterWrapper(new StatoCivileSezioniGetter($em))
            );
            $helper->setupSezioniRecords(array());
            $helper->formatSezioniForFormSelect($helper->getSezioniRecords());

            //$form = $helper->setupFormSearch( new StatoCivileFormSearch() );
            //$form->setData( $this->getRequest()->isPost() ? $this->getRequest()->getPost() : array() );

            $wrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($em) );
            $wrapper->setInput(array_merge(
                array(
                    'textSearch' => $this->params()->fromPost('testo'),
                    'anno'       => $this->params()->fromPost('anno'),
                    'mese'       => $this->params()->fromPost('mese'),
                    'sezione'    => $this->params()->fromPost('sezione')
                ),
                array(
                    'orderBy' => 'sca.data DESC',
                    'sca.attivo' => 1
                )
            ));
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($em) );
            $wrapper->setupPaginatorCurrentPage(isset($page) ? $page : null);

            $paginatorRecords = $wrapper->getPaginator();

        } catch(\Exception $e) {

        }

        $this->layout()->setVariables(array(
            'paginator'         => !empty($paginatorRecords) ? $paginatorRecords : null,
            'form'              => !empty($form) ? $form : null,
            'records'           => !empty($paginatorRecords) ? $paginatorRecords : null,
            'templatePartial'   => 'stato-civile/stato-civile.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}