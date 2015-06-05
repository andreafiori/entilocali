<?php

namespace Application\Controller\StatoCivile;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\StatoCivile\StatoCivileFormSearch;
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
        $perPage = $this->params()->fromRoute('perpage');

        try {

            $helper = new StatoCivileControllerHelper();
            $sezioniRecords = $helper->recoverWrapperRecords(
                new StatoCivileSezioniGetterWrapper(new StatoCivileSezioniGetter($em)),
                array()
            );
            $sezioniRecordsForDropdown = $helper->formatForDropwdown(
                $sezioniRecords,
                'id',
                'nome'
            );
            $wrapper = $helper->recoverWrapperRecordsPaginator(
                new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
                array_merge(
                    array(
                        'textSearch' => $this->params()->fromPost('testo'),
                        'anno'       => $this->params()->fromPost('anno'),
                        'mese'       => $this->params()->fromPost('mese'),
                        'sezione'    => $this->params()->fromPost('sezione')
                    ),
                    array(
                        'attivo'    => 1,
                        'noScaduti' => 1,
                        'orderBy'   => 'sca.data DESC',
                    )
                ),
                $page,
                $perPage
            );

            $paginator = $wrapper->getPaginator();

            $form = new StatoCivileFormSearch();
            $form->addTesto();
            $form->addSezioni($sezioniRecordsForDropdown);
            $form->addMese();
            $form->addAnni();
            $form->addSubmitButton();

        } catch(\Exception $e) {

        }

        $this->layout()->setVariables(array(
            'paginator'         => !empty($paginator) ? $paginator : null,
            'records'           => !empty($paginator) ? $paginator : null,
            'form'              => !empty($form) ? $form : null,
            'templatePartial'   => 'stato-civile/stato-civile.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}