<?php

namespace Admin\Controller\StatoCivile\Sezioni;

use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use ModelModule\Model\StatoCivile\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use ModelModule\Model\StatoCivile\StatoCivileSezioniForm;
use Application\Controller\SetupAbstractController;

class StatoCivileSezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id     = $this->params()->fromRoute('id');
        $lang   = $this->params()->fromRoute('lang');
        $em     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new StatoCivileControllerHelper();
        $records = $helper->recoverWrapperRecordsById(
            new StatoCivileSezioniGetterWrapper(new StatoCivileSezioniGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );

        $form = new StatoCivileSezioniForm();

        if (!empty($records)) {
            $form->setData($records[0]);

            $formAction = 'stato-civile-sezioni/update';
            $formTitle = 'Modifica';
        } else {
            $formAction = 'stato-civile-sezioni/insert';
            $formTitle = 'Nuova';
        }

        $this->layout()->setVariables(array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => 'Compila il form e premi il pulsante per confermare',
                'formBreadCrumbCategory'     => array(
                    array(
                        'label' => 'Stato civile',
                        'href' => $this->url()->fromRoute('admin/stato-civile-summary', array(
                            'lang' => $lang
                        )),
                        'title' => "Elenco atti stato civile"
                    ),
                    array(
                        'label' => 'Sezioni',
                        'href' =>  $this->url()->fromRoute('admin/stato-civile-sezioni-summary', array(
                            'lang' => $lang
                        )),
                        'title' => "Elenco sezioni stato civile"
                    ),
                ),
                'templatePartial' => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}