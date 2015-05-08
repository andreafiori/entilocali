<?php

namespace Application\Controller\StatoCivile;

use Application\Controller\SetupAbstractController;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use Application\Model\StatoCivile\StatoCivileControllerHelper;
use Application\Model\StatoCivile\StatoCivileFormSearch;

/**
 * @author Andrea Fiori
 * @since  18 April 2015
 */
class StatoCivileController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        $helper = new StatoCivileControllerHelper();
        $helper->setStatoCivileSezioniGetterWrapper(
            new StatoCivileSezioniGetterWrapper(new StatoCivileSezioniGetter($em))
        );
        $helper->setupSezioniRecords(array());
        $helper->formatSezioniForFormSelect($helper->getSezioniRecords());

        $form = $helper->setupFormSearch( new StatoCivileFormSearch() );
        $form->setData( $this->getRequest()->isPost() ? $this->getRequest()->getPost() : array() );

        $wrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($em) );
        $wrapper->setInput( array_merge(
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
            )
        );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage(isset($page) ? $page : null);

        $paginatorRecords = $wrapper->getPaginator();

        $this->layout()->setVariables(array(
            'paginator'         => $paginatorRecords,
            'form'              => $form,
            'records'           => $paginatorRecords,
            'templatePartial'   => 'stato-civile/stato-civile.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}