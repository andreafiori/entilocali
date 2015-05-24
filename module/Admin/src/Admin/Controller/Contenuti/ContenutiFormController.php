<?php

namespace Admin\Controller\Contenuti;

use Admin\Model\Contenuti\ContenutiControllerHelper;
use Admin\Model\Contenuti\ContenutiForm;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Application\Controller\SetupAbstractController;

class ContenutiFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id                     = $this->params()->fromRoute('id');
        $em                     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $userDetails            = $this->layout()->getVariable('userDetails');
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
                $formAction             = 'contenuti/update/';
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
                $formAction             = 'contenuti/insert/';
                $formBreadCrumbTitle    = 'Nuovo contenuto';
            }

            $this->layout()->setVariables( array(
                    'form'                       => $form,
                    'formAction'                 => $formAction,
                    'formTitle'                  => $formTitle,
                    'formDescription'            => $formDescription,
                    'submitButtonValue'          => $submitButtonValue,
                    'CKEditorField'              => array('testo'),
                    'formBreadCrumbCategory'     => 'Contenuti',
                    'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/contenuti-summary', array('lang' => 'it')),
                    'formBreadCrumbTitle'        => $formBreadCrumbTitle,
                    'templatePartial'            => self::formTemplate
                )
            );

        } catch(\Exception $e) {

        }

        $this->layout()->setTemplate($mainLayout);
    }
}