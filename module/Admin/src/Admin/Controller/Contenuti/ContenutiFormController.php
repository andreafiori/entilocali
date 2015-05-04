<?php

namespace Admin\Controller\Contenuti;

use Admin\Model\Contenuti\ContenutiForm;
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

        $id             = $this->params()->fromRoute('id');
        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $configurations = $this->layout()->getVariable('configurations');
        $userDetails    = $this->layout()->getVariable('userDetails');

        if (is_numeric($id)) {
            $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($em) );
            $wrapper->setInput( array(
                    'id'     => $id,
                    'limit'  => 1,
                    'utente' => ($userDetails->role=='WebMaster') ? null : $userDetails->id
                )
            );
            $wrapper->setupQueryBuilder();

            $recordFromDb = $wrapper->getRecords();
        }

        $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($em) );
        $wrapper->setInput(array(
            'excludeId'             => isset($configurations['amministrazione_trasparente_sottosezione_id']) ? $configurations['amministrazione_trasparente_sottosezione_id'] : null,
            'excludeSezioneId'      => isset($configurations['amministrazione_trasparente_sezione_id']) ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'showToAll'             => ($userDetails->role=='WebMaster') ? null : 1,
        ));
        $wrapper->setupQueryBuilder();

        $sezioniRecords = $wrapper->getRecords();

        $arraySezioni= array();
        if (!empty($sezioniRecords)) {
            foreach($sezioniRecords as $sezioniRecord) {
                $arraySezioni[$sezioniRecord['idSottoSezione']] = utf8_encode($sezioniRecord['nomeSezione']). ' - '.utf8_encode($sezioniRecord['nomeSottoSezione']);
            }
        }

        $form = new ContenutiForm();
        $form->addSottoSezioni($arraySezioni);
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

        if ( !empty($recordFromDb) ) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue  = 'Modifica';
            $formTitle          = 'Modifica contenuto';
            $formDescription    = null;
            $formAction         = 'contenuti/update/';
        } else {
            $form->addSocial();

            $formTitle          = 'Nuovo contenuto';
            $formDescription    = 'Inserisci i dati relativi al contenuto';
            $submitButtonValue  = 'Inserisci';
            $formAction         = 'contenuti/insert/';
        }

        $this->layout()->setVariables( array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => $formDescription,
                'submitButtonValue'          => $submitButtonValue,
                'CKEditorField'              => array('sommario', 'testo'),
                'formBreadCrumbCategory'     => 'Contenuti',
                'formBreadCrumbCategoryLink' => 'datatable/contenuti/',
                'templatePartial'            => self::formTemplate
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}