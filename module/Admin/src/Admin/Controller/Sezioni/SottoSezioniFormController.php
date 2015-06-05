<?php

namespace Admin\Controller\Sezioni;

use ModelModule\Model\Sezioni\SezioniControllerHelper;
use ModelModule\Model\Sezioni\SezioniGetter;
use ModelModule\Model\Sezioni\SezioniGetterWrapper;
use ModelModule\Model\Sezioni\SottoSezioniForm;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class SottoSezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em                 = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $configurations     = $this->layout()->getVariable('configurations');
        $id                 = $this->params()->fromRoute('id');
        $modulename         = $this->params()->fromRoute('modulename');
        $lang               = $this->params()->fromRoute('lang');
        $page               = $this->params()->fromRoute('page');
        $languageSelection  = $this->params()->fromRoute('languageSelection');

        try {
            $helper = new SezioniControllerHelper();
            $sezioniRecords = $helper->recoverWrapperRecords(
                new SezioniGetterWrapper(new SezioniGetter($em)),
                array(
                    'fields' => 'sezioni.id, sezioni.nome',
                    'isAmmTrasparente' => ($modulename!='contenuti') ? 1 : 0,
                    'orderBy' => 'sezioni.nome'
                )
            );
            $helper->checkRecords(
                $sezioniRecords,
                'Nessuna sezione in archivio. Impossibile inserire una sottosezione. Inserire almeno una sezione'
            );
            /*
            $helper->recoverWrapperRecords(
                new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)),

            );
            */
            $sottoSezioniRecords = $helper->recoverWrapperRecordsById(
                new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)),
                array('id' => $id, 'limit' => 1),
                $id
            );

            $form = new SottoSezioniForm();
            $form->addSezioni( $helper->formatForDropwdown($sezioniRecords,'id','nome') );
            $form->addMainFormInputs();

            if (!empty($sottoSezioniRecords)) {
                $form->setData($sottoSezioniRecords[0]);

                $formTitle              = $sottoSezioniRecords[0]['nomeSottoSezione'];
                $formAction             = '#';
                $submitButtonValue      = 'Modifica';
                $formBreadCrumbTitle    = 'Modifica';

            } else {
                $formTitle              = 'Nuova sottosezione';
                $formBreadCrumbTitle    = 'Nuova';
                $submitButtonValue      = 'Inserisci';
                $formAction             = '#';
            }

            $this->layout()->setVariables(array(
                'form'                          => $form,
                'formAction'                    => $formAction,
                'formTitle'                     => $formTitle,
                'formDescription'               => 'Dati relativi alle sotto sezioni',
                'noFormActionPrefix'            => 1,
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbTitle'           => $formBreadCrumbTitle,
                'formBreadCrumbCategory'        => 'Sottosezioni',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/sottosezioni-summary', array(
                    'lang'               => $lang,
                    'languageSelection'  => $languageSelection,
                    'modulename'         => $modulename,
                    'previouspage'       => $page,
                )),
                'templatePartial'               => self::formTemplate,
            ));

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                'messageType'        => 'warning',
                'messageTitle'       => 'Errore verificato',
                'messageText'        => $e->getMessage(),
                'templatePartial'    => 'message.phtml',
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}