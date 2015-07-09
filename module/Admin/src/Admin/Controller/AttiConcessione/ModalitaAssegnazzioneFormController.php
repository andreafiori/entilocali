<?php

namespace Admin\Controller\AttiConcessione;

use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneForm;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetter;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetterWrapper;
use Application\Controller\SetupAbstractController;

class ModalitaAssegnazioneFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id     = $this->params()->fromRoute('id');
        $em     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $form   = new AttiConcessioneModalitaAssegnazioneForm();

        try {

            $wrapper = new AttiConcessioneModalitaAssegnazioneGetterWrapper(
                new AttiConcessioneModalitaAssegnazioneGetter($em)
            );
            $wrapper->setInput(array(
                'id' => $id,
                'limit' => is_numeric($id) ? 1 : null,
            ));
            $wrapper->setupQueryBuilder();

            $modalitaRecords = $wrapper->getRecords();

            if ( !empty($modalitaRecords) ) {

                $form->setData($modalitaRecords[0]);

                $formAction = $this->url()->fromRoute('admin/atti-concessione-modalita-assegnazione-update', array(
                    'lang' => $this->params()->fromRoute('lang')
                ));
                $formTitle = 'Modifica assegnazione atti concessione';

            } else {
                $formAction = $this->url()->fromRoute('admin/atti-concessione-modalita-assegnazione-insert', array(
                    'lang' => $this->params()->fromRoute('lang')
                ));
                $formTitle  = 'Nuova modalit&agrave; assegnazione atti concessione';
            }

            $this->layout()->setVariables(array(
                'form'                          => $form,
                'formAction'                    => $formAction,
                'formTitle'                     => $formTitle,
                'formDescription'               => "Compila i dati relativi alla modalit&agrave; assegnazione",
                'templatePartial'               => self::formTemplate,
                'formBreadCrumbTitle'           => 'Modalit&agrave; assegnazione',
                'formBreadCrumbCategory' => array(
                    array(
                        'href'  => $this->url()->fromRoute('admin/users-responsabili-procedimento', array(
                            'lang' => $this->params()->fromRoute('lang')
                        )),
                        'label' => 'Atti di concessione',
                        'title' => 'Elenco atti di concessione',
                    ),
                ),
            ));

        } catch(NullException $e) {

            $message = $e->getParams();

            $this->layout()->setVariables(array(
                'messageType'     => $message['type'],
                'messageTitle'    => $message['title'],
                'messageText'     => $message['text'],
                'templatePartial' => 'message.phtml',
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }
}