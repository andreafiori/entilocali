<?php

namespace Admin\Controller\Configurations;

use ModelModule\Model\Config\ConfigForm;
use ModelModule\Model\Config\ConfigGetter;
use ModelModule\Model\Config\ConfigGetterWrapper;
use Application\Controller\SetupAbstractController;

class ConfigurationsFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $configurations = $this->layout()->getVariable('configurations');

        $userDetails = $this->recoverUserDetails();

        $wrapper = new ConfigGetterWrapper(new ConfigGetter($em));
        $wrapper->setInput(array(
            'languageAbbreviation' => '',
        ));
        $wrapper->setupQueryBuilder();

        $form = new ConfigForm();
        $form->addMainConfigs();

        if ($userDetails->role == 'WebMaster') {
            $form->addTemplates();
            $form->addProject();
            $form->addAmazonS3Fields();
            $form->addPasswordPreviewArea();
        }

        $form->setData($configurations);

        $this->layout()->setVariables(array(
            'form'                       => $form,
            'formAction'                 => '#',
            'formTitle'                  => 'Configurazioni',
            'formDescription'            => 'Opzioni principali applicazione.',
            'templatePartial'            => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}
