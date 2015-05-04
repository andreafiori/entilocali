<?php

namespace Admin\Controller\StatoCivile\Sezioni;

use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use Admin\Model\StatoCivile\StatoCivileSezioniForm;
use Application\Controller\SetupAbstractController;

class StatoCivileSezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $form = new StatoCivileSezioniForm();

        if ( is_numeric($id) ) {
            $wrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($em) );
            $wrapper->setInput(array('scs.id' => $id));
            $wrapper->setupQueryBuilder();

            $record = $wrapper->getRecords();
        }

        if (!empty($record)) {
            $form->setData($record[0]);

            $formAction = 'stato-civile-sezioni/update';
            $formTitle = 'Modifica sezione stato civile';
        } else {
            $formAction = 'stato-civile-sezioni/insert';
            $formTitle = 'Nuova sezione stato civile';
        }

        $this->layout()->setVariables(array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => 'Compila il form e premi il pulsante per confermare',
                'formBreadCrumbCategory'     => 'Sezioni stato civile',
                'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/stato-civile-sezioni-summary', array(
                    'lang' => 'it'
                )),
                'templatePartial'            => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}