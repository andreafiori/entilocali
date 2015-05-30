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
        $ammTraspSezioneId      = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');
        $ammTraspSottoSezioneId = $this->layout()->getVariable('amministrazione_trasparente_sottosezione_id');

        try {
            $helper = new ContenutiControllerHelper();
            $helper->setContenutiGetterWrapper( new ContenutiGetterWrapper(new ContenutiGetter($em)) );
            $helper->setupContenutiGetterWrapperRecords(array(
                'id'     => is_numeric($id) ? $id : 0,
                'limit'  => 1,
                'utente' => ($userDetails->role=='WebMaster') ? null : $userDetails->id
            ));
            $helper->setSottoSezioniGetterWrapper(new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)));
            $helper->setupSottoSezioniGetterWrapperRecords(array(
                'excludeId'             => $ammTraspSottoSezioneId,
                'excludeSezioneId'      => $ammTraspSezioneId,
                'showToAll'             => ($userDetails->role == 'WebMaster') ? null : 1,
                'languageAbbreviation'  => $languageSelection,
            ));
            $helper->formatSottoSezioniGetterWrapperRecordsForDropdown();

            $contenutiRecords = $helper->getContenutiGetterWrapperRecords();

            $form = new ContenutiForm();
            $form->addSottoSezioni( $helper->getSottoSezioniGetterWrapperRecords() );
            $form->addForm();
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
                $formTitle              = 'Modifica contenuto';
                $formDescription        = 'Modifica i dati relativi al contenuto';
                $formAction             = $this->url()->fromRoute('admin/contenuti-update', array(
                        'lang'              => $this->params()->fromRoute('lang'),
                        'languageSelection' => $languageSelection,
                    )
                );
                $formBreadCrumbTitle    = '';

            } else {
                $form->setData(array(
                    'dataInserimento'   => date('Y-m-d H:i:s'),
                    'dataScadenza'      => date('Y-m-d H:i:s', strtotime('+5 years')),
                    'attivo'            => 1,
                    'utente'            => $userDetails->id,
                ));
                $form->addSocial();

                $formTitle              = 'Nuovo contenuto';
                $formDescription        = 'Inserisci i dati relativi al contenuto';
                $submitButtonValue      = 'Inserisci';
                $formAction             = $this->url()->fromRoute('admin/contenuti-insert', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $languageSelection,
                ));
                $formBreadCrumbTitle    = 'Nuovo contenuto';
            }

            $this->layout()->setVariables(array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => $formDescription,
                'submitButtonValue'          => $submitButtonValue,
                'CKEditorField'              => array('testo'),
                'formBreadCrumbCategory'     => 'Contenuti',
                'noFormActionPrefix'         => 1,
                'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/contenuti-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $languageSelection,
                    'page'              => $this->params()->fromRoute('previouspage'),
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