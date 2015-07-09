<?php

namespace Admin\Controller\Newsletter;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Newsletter\NewsletterControllerHelper;
use ModelModule\Model\Newsletter\NewsletterForm;
use ModelModule\Model\Newsletter\NewsletterGetter;
use ModelModule\Model\Newsletter\NewsletterGetterWrapper;

class NewsletterFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new NewsletterControllerHelper();
        $records = $helper->recoverWrapperRecordsById(
            new NewsletterGetterWrapper(new NewsletterGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );

        $form = new NewsletterForm();

        if (!empty($records)) {
            $form->setData($records[0]);

            $submitButtonValue  = 'Modifica';
            $formTitle          = 'Modifica newsletter';
            $formAction         =  $this->url()->fromRoute('admin/newsletter-update', array(
                'lang' => $lang
            ));
        } else {
            $formTitle          = 'Nuova newsletter';
            $submitButtonValue  = 'Inserisci';
            $formAction         = $this->url()->fromRoute('admin/newsletter-insert', array(
                'lang' => $lang
            ));
        }

        $this->layout()->setVariables( array(
                'formTitle'                     => $formTitle,
                'formDescription'               => "Compila i dati relativi a alla newsletter",
                'form'                          => $form,
                'formAction'                    => $formAction,
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbCategory'        => 'Newsletter',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/newsletter-summary', array(
                    'lang' => $lang
                )),
                'templatePartial'               => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}