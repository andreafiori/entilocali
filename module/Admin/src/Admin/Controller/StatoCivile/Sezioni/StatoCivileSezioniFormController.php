<?php

namespace Admin\Controller\StatoCivile\Sezioni;

use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetterWrapper;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniForm;
use Application\Controller\SetupAbstractController;

class StatoCivileSezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id     = $this->params()->fromRoute('id');
        $lang   = $this->params()->fromRoute('lang');

        $helper = new StatoCivileControllerHelper();
        $records = $helper->recoverWrapperRecordsById(
            new StatoCivileSezioniGetterWrapper(new StatoCivileSezioniGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );

        $form = new StatoCivileSezioniForm();

        if (!empty($records)) {
            $form->setData($records[0]);

            $formAction = $this->url()->fromRoute('admin/stato-civile-sezioni-update', array(
                'lang' => $lang
            ));
            $formTitle = 'Modifica sezione';
            $formBreadCrumbTitle = 'Modifica';
        } else {
            $formAction = $this->url()->fromRoute('admin/stato-civile-sezioni-insert', array(
                'lang' => $lang
            ));
            $formTitle = 'Nuova';
            $formBreadCrumbTitle = 'Nuova sezione';
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
                'formBreadCrumbTitle'	=> $formBreadCrumbTitle,
                'templatePartial'		=> self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}