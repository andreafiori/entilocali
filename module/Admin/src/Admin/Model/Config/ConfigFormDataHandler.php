<?php

namespace Admin\Model\Config;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  14 March 2015
 */
class ConfigFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $wrapper = new ConfigGetterWrapper( new ConfigGetter($this->getInput('entityManager', 1)) );
        $wrapper->setInput(array(

        ));
        $wrapper->setupQueryBuilder();

        $form = new ConfigForm();
        $form->addMainConfigs();

        if ($this->isRole('WebMaster')) {
            $form->addTemplates();
            $form->addProject();
            $form->addAmazonS3Fields();
            $form->addPasswordPreviewArea();
        }
        $form->setData($this->getInput('configurations', 1));

        $formAction = 'configurations/update';
        $formTitle  = 'Configurazioni';

        $this->setVariables(array(
            'form'                       => $form,
            'formAction'                 => $formAction,
            'formTitle'                  => $formTitle,
            'formDescription'            => 'Opzioni principali applicazione.',
        ));
    }
}