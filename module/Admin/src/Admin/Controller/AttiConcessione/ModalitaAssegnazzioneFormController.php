<?php

namespace Admin\Controller\AttiConcessione;

use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneForm;
use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetter;
use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetterWrapper;
use Application\Controller\SetupAbstractController;

class ModalitaAssegnazioneFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id             = $this->params()->fromRoute('id');
        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $form           = new AttiConcessioneModalitaAssegnazioneForm();

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

            if ( !empty($articoliRecords) ) {

                $form->setData($modalitaRecords[0]);

                $formAction = 'atti-concessione-modalita-assegnazione/update/'.$modalitaRecords[0]['id'];

                $formTitle = $modalitaRecords[0]['nome'];

            } else {
                $formAction = 'atti-concessione-modalita-assegnazione/insert/';

                $formTitle  = 'Nuova modalit&agrave;';
            }

            $this->layout()->setVariables(array(
                    'form'                          => $form,
                    'formAction'                    => $formAction,
                    'formTitle'                     => $formTitle,
                    'formDescription'               => "Compila i dati relativi alla modalit&agrave; assegnazione",
                    'templatePartial'               => self::formTemplate,
                    'formBreadCrumbCategory'        => 'Modalit&agrave; assegnazione atti di concessione',
                    'formBreadCrumbCategoryLink'    => ''
                )
            );

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