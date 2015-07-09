<?php

namespace Admin\Controller\Contenuti;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Contenuti\ContenutiTabellaForm;

class ContenutiTabellaFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        $helper = new ContenutiControllerHelper();
        $contenutiRecords = $helper->recoverWrapperRecordsById(
            new ContenutiGetterWrapper(new ContenutiGetter($em)),
            array('id' => $id, 'limit' => 1, 'fields' => 'contenuti.id, contenuti.titolo, contenuti.tabella'),
            $id
        );

        $form = new ContenutiTabellaForm();
        $formAction = $this->url()->fromRoute('admin/amministrazione-trasparente-tabella-update', array(
            'lang'              => $this->params()->fromRoute('lang'),
            'languageSelection' => $this->params()->fromRoute('languageSelection'),
            'modulename'        => 'amministrazione-trasparente',
        ));
        $formTitle = $contenutiRecords[0]['titolo'];
        $formDescription = "Compila i dati della tabella (dati aggiuntivi all'articolo)";

        if (!empty($contenutiRecords[0])) {
            $form->setData($contenutiRecords[0]);
        }

        $this->layout()->setVariables(array(
            'form'                       => $form,
            'formAction'                 => $formAction,
            'formTitle'                  => $formTitle,
            'formDescription'            => $formDescription,
            'submitButtonValue'          => 'Aggiorna',
            'CKEditorField'              => array('tabella'),
            'formBreadCrumbCategory'     => array(
                array(
                    'href' => $this->url()->fromRoute('admin/contenuti-summary', array(
                        'lang'              => $this->params()->fromRoute('lang'),
                        'languageSelection' => $this->params()->fromRoute('languageSelection'),
                        'modulename'        => 'amministrazione-trasparente',
                    )),
                    'label' => 'Amministrazione Trasparente',
                    'title' => 'Vai alla gestione amministrazione Trasparente'
                ),
                array(
                    'href' => '#',
                    'label' => 'Articolo',
                    'title' => "Vai alla gestione dell'articolo",
                ),
            ),
            'formBreadCrumbTitle'  => 'Gestione tabella aggiuntiv',
            'templatePartial'      => self::formTemplate
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}