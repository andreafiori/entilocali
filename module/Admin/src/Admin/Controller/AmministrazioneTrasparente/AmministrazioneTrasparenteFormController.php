<?php

namespace Admin\Controller\AmministrazioneTrasparente;

use ModelModule\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteForm;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class AmministrazioneTrasparenteFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($em) );
        $wrapper->setInput(array(
            'sezioneId' => $configurations['amministrazione_trasparente_sezione_id'],
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setEntityManager($em);

        $sottosezioniRecords = $wrapper->getRecords();

        $sezioniOptions = array();
        foreach($sottosezioniRecords as $sottosezione) {

            if (isset($sottosezione['profonditaDa'])) {

                $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($em) );
                $wrapper->setInput(array(
                    'sezioneId' => $configurations['amministrazione_trasparente_sezione_id'],
                    'profonditaDa' => ''
                ));
                $wrapper->setupQueryBuilder();

                $sottosezioniRecords2 = $wrapper->getRecords();
                if (!empty($sottosezioniRecords2)) {
                    foreach($sottosezioniRecords2 as $sottosezione2) {
                        if (isset($sottosezione['idSottosezione'])) {
                            $sezioniOptions[$sottosezione['idSottosezione']] = $sottosezione['nomeSottosezione'].' > '.$sottosezione2['nomeSottosezione'];
                        }
                    }
                }

            } else {
                if (isset($sottosezione['idSottosezione'])) {
                    $sezioniOptions[$sottosezione['idSottosezione']] = $sottosezione['nomeSezione'].' > '.$sottosezione['nomeSottosezione'];
                }
            }
        }

        $form = new AmministrazioneTrasparenteForm();
        $form->addSezione($sezioniOptions);
        $form->addEndForm();

        if ( is_numeric($id) ) {
            $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($em) );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
        }

        if ( !empty($records)) {
            $formAction      = 'amministrazione-trasparente/update';
            $formTitle       = 'Modifica articolo';
            $formDescription = 'Modifica articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo';

            $form->setData($records[0]);
        } else {
            $form->addSocial();
            $form->setData(array(
                'anno'         => date("Y"),
                'dataScadenza' => date('Y-m-d', strtotime('+5 years')),
            ));

            $formAction      = 'amministrazione-trasparente/insert';
            $formTitle       = 'Nuovo articolo';
            $formDescription = 'Inserisci nuovo articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo';
        }

        $this->layout()->setVariables(array(
            'formTitle'                  => $formTitle,
            'formDescription'            => $formDescription,
            'form'                       => $form,
            'formAction'                 => $formAction,
            'templatePartial'            => self::formTemplate,
            'formBreadCrumbCategory'     => 'Amministrazione Trasparente',
            'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/amministrazione-trasparente-summary', array(
                    'lang'  => 'it'
                )
            ),
            'CKEditorField'              => array('testo'),
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}