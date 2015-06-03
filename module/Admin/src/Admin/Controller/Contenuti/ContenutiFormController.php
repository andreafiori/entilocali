<?php

namespace Admin\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiForm;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
use Application\Controller\SetupAbstractController;

class ContenutiFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id                     = $this->params()->fromRoute('id');
        $em                     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $userDetails            = $this->layout()->getVariable('userDetails');
        $languageSelection      = $this->params()->fromRoute('languageSelection');
        $modulename             = $this->params()->fromRoute('modulename');
        $subsection             = $this->params()->fromQuery('subsection');

        try {
            $helper = new ContenutiControllerHelper();
            $helper->setSottoSezioniGetterWrapper(new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)));
            $helper->setupSottoSezioniGetterWrapperRecords(array(
                'showToAll'             => ($userDetails->role == 'WebMaster') ? null : 1,
                'languageAbbreviation'  => $languageSelection,
                'isAmmTrasparente'      => ($modulename!='contenuti') ? 1 : null,
            ));
            $helper->checkRecords($helper->getSottoSezioniGetterWrapperRecords(),'Nessuna sottosezione presente');
            $helper->formatSottoSezioniGetterWrapperRecordsForDropdown();
            $contenutiRecords = $helper->recoverWrapperRecordsById(
                new ContenutiGetterWrapper(new ContenutiGetter($em)),
                array(
                    'id'     => $id,
                    'limit'  => 1,
                    'utente' => ($userDetails->role=='WebMaster') ? null : $userDetails->id
                ),
                $id
            );

            $form = new ContenutiForm();
            $form->addSottoSezioni( $helper->getSottoSezioniGetterWrapperRecords() );
            $form->addMainFormElements();
            if ($userDetails->role=='WebMaster') {
                $wrapper = new UsersGetterWrapper( new UsersGetter($em) );
                $wrapper->setInput( array('orderBy' => 'u.name') );
                $wrapper->setupQueryBuilder();

                $records = $wrapper->getRecords();

                $arrayToReturn = array();
                if (!empty($records)) {
                    foreach($records as $record) {
                        $arrayToReturn[$record['id']] = utf8_encode($record['name']). ' '.utf8_encode($record['surname']);
                    }
                }

                $form->addUsers($arrayToReturn);
            }
            $form->addHomeBox();

            if ( !empty($contenutiRecords) ) {
                $form->setData($contenutiRecords[0]);

                $submitButtonValue      = 'Modifica';
                $formTitle              = 'Modifica artciolo';
                $formDescription        = "Modifica i dati relativi all'articolo. Massimo 255 caratteri per i campi testo. Utilizzare testi brevi e concisi. <strong>Evitare copia \ incolla da file word</strong> o pagine web che potrebbero danneggiare il layout della pagina.";
                $formAction             = $this->url()->fromRoute('admin/contenuti-update', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $languageSelection,
                ));
                $formBreadCrumbTitle    = '';

            } else {
                $form->setData(array(
                    'dataInserimento'   => date('Y-m-d H:i:s'),
                    'dataScadenza'      => date('Y-m-d H:i:s', strtotime('+5 years')),
                    'attivo'            => 1,
                    'utente'            => $userDetails->id,
                ));
                $form->addSocial();

                $formTitle              = 'Nuovo articolo';
                $formDescription        = "Inserisci i dati relativi all'articolo. Massimo 255 caratteri per i campi testo. Utilizzare testi brevi e concisi. <strong>Evitare copia \ incolla da file word</strong> o pagine web che potrebbero danneggiare il layout della pagina.";
                $submitButtonValue      = 'Inserisci';
                $formAction             = $this->url()->fromRoute('admin/contenuti-insert', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $languageSelection,
                ));
                $formBreadCrumbTitle    = 'Nuovo artciolo';
            }

            $this->layout()->setVariables(array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => $formDescription,
                'submitButtonValue'          => $submitButtonValue,
                'CKEditorField'              => array('testo'),
                'formBreadCrumbCategory'     => ucfirst(str_replace('-', ' ', $modulename)),
                'noFormActionPrefix'         => 1,
                'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/contenuti-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'page'              => $this->params()->fromRoute('previouspage'),
                    'languageSelection' => $languageSelection,
                    'modulename'        => $modulename,
                )),
                'formBreadCrumbTitle'  => $formBreadCrumbTitle,
                'templatePartial'      => self::formTemplate
            ));

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageType'   => 'warning',
                'messageTitle'  => 'Errore verificato',
                'messageText'   => 'Messaggio generato '.$e->getMessage(),
                'templatePartial' => 'message.phtml',
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }
}