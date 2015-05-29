<?php

namespace Admin\Controller\Sezioni;

use Admin\Model\Sezioni\SottoSezioniForm;
use Application\Controller\SetupAbstractController;

class SottoSezioniContenutiFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $configurations = $this->layout()->getVariable('configurations');

        $form = new SottoSezioniForm();
        if (!empty($recordFromDb)) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue  = 'Modifica';
            $formTitle          = 'Modifica sottosezione';
            $formAction         = '#';
        } else {
            $formTitle          = 'Nuova sottosezione';
            $submitButtonValue  = 'Inserisci';
            $formAction         = '#';
        }

        $this->layout()->setVariables( array(
                'formTitle'                     => $formTitle,
                'formDescription'               => "Compila i dati relativi a alla sottosezione",
                'form'                          => $form,
                'formAction'                    => $formAction,
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbCategory'        => 'Sottosezioni',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/contenuti-summary', array('lang' => 'it')),
                'templatePartial'               => 'formdata/formdata.phtml'
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        if (is_numeric($id)) {
            $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($em) );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
        $recordFromDb = $this->getSottoSezioniFormRecord($id);

        $this->setRecord($recordFromDb);

        $sezioniOptions = $this->getSezioniRecords(array(
            'fields'    => 'sezioni.id, sezioni.nome',
            'id'        => ($param['route']['formsetter']=='sottosezioni-amm-trasparente') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'excludeId' => ($param['route']['formsetter']=='sottosezioni-contenuti') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'orderBy'   => 'sezioni.nome'
        ));

        if (empty($sezioniOptions)) {
            // error...
            return;
        }

        $form = new SottoSezioniForm();
        $form->addSezioni( $this->formatSezioniRecordsForFormSelect($sezioniOptions) );
        $form->addMainFormInputs();

        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $formTitle  = $recordFromDb[0]['nomeSottoSezione'];
            $formAction = 'sottosezioni-contenuti/update/';
            $submitButtonValue = 'Modifica';
        } else {
            $formTitle          = 'Nuova sotto sezione';
            $submitButtonValue  = 'Inserisci';
            $formAction         = 'sottosezioni-contenuti/insert/';
        }

        $baseUrl = $this->getInput('baseUrl', 1);

        $this->setVariables( array(
                'form'                   => $form,
                'formAction'             => $formAction,
                'formTitle'              => $formTitle,
                'formDescription'        => 'Dati relativi alle sotto sezioni',
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => 'Sotto sezioni',
                'formBreadCrumbCategoryLink' => $baseUrl.'datatable/sottosezioni-contenuti/',
            )
        );
    }

    /**
     * @param int|null $id
     * @return array|null
     */
    private function getSottoSezioniFormRecord($id)
    {


        return null;
    }

    /**
     * @param array $input
     *
     * @return array
     */
    private function getSezioniRecords(array $input)
    {
        $wrapper = new SezioniGetterWrapper( new SezioniGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        return $wrapper->getRecords();
    }

    /**
     * @param array $records
     *
     * @return array
     */
    private function formatSezioniRecordsForFormSelect(array $records)
    {
        $arrayToReturn = array();
        foreach($records as $record) {
            $arrayToReturn[$record['id']] = $record['nome'];
        }
        return $arrayToReturn;
    }
}