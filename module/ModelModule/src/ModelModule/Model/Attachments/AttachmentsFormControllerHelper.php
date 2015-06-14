<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\NullException;

class AttachmentsFormControllerHelper extends AttachmentsFormControllerHelperAbstract
{
    private $propertiesGetterClassPath;

    private $propertiesGetterClassInstance;

    private $attachmentsForm;

    /**
     * @param $moduleSlug
     */
    public function setupModuleRecords($moduleSlug)
    {
        $this->assertModulesGetterWrapper();

        $this->getModulesGetterWrapper()->setInput( array('code' => $moduleSlug, 'limit' => 1) );
        $this->getModulesGetterWrapper()->setupQueryBuilder();

        $this->moduleRecords = $this->getModulesGetterWrapper()->getRecords();
    }

    /**
     * @return int|null
     */
    public function recoverModuleId()
    {
        return isset($this->moduleRecords[0]['id']) ? $this->moduleRecords[0]['id'] : null;
    }

    /**
     * @throws NullException
     */
    public function checkModuleRecords()
    {
        $moduleRecords = $this->getModuleRecords();

        if ( !isset($moduleRecords[0]['id']) ) {
            throw new NullException("Il presente modulo non &egrave; stato trovato. Se l'errore persiste, contattare l'amministrazione");
        }
    }

    /**
     * @param array $input
     * @return array
     */
    public function setupAttachmentsRecords($input = array())
    {
        $this->assertAttachmentsGetterWrapper();

        $this->getAttachmentsGetterWrapper()->setInput($input);
        $this->getAttachmentsGetterWrapper()->setupQueryBuilder();

        $this->attachmentRecords = $this->getAttachmentsGetterWrapper()->getRecords();
    }

    /**
     * @throws NullException
     */
    public function chekcModuleCodeOnClassMap()
    {
        if (!isset($this->classMap[$this->getModuleCode()])) {
            throw new NullException("Module code is not set on class map array list");
        }
    }

    public function setupPropertiesGetterClassPath()
    {
        $this->chekcModuleCodeOnClassMap();

        $classPath = $this->classMap[$this->getModuleCode()];

        $this->checkClassMapClassExists($classPath);

        $this->propertiesGetterClassPath = $classPath;
    }

    /**
     * @param $classPath
     * @throws NullException
     */
    private function checkClassMapClassExists($classPath)
    {
        if (!class_exists($classPath)) {
            throw new NullException("Attachment properties getter is not a valid class on class map list");
        }
    }

    /**
     * @return \Admin\Model\Attachments\AttachmentPropertiesGetterChildAbstract
     */
    public function getPropertiesGetterClassInstance()
    {
        return $this->propertiesGetterClassInstance;
    }

    public function setupPropertiesGetterClassInstance()
    {
        $classPath = $this->getPropertiesGetterClassPath();

        $this->propertiesGetterClassInstance = new $classPath();
    }

    /**
     * Recover object property getter class name from map
     */
    public function recoverPropertiesGetter()
    {
        $moduleCode = $this->getModuleCode();

        return isset($this->classMap[$moduleCode]) ? $this->classMap[$moduleCode] : null;
    }

    /**
     * @return mixed
     */
    public function getPropertiesGetterClassPath()
    {
        return $this->propertiesGetterClassPath;
    }

    /**
     * @param AttachmentsForm $form
     */
    public function setAttachmentsForm(AttachmentsForm $form)
    {
        $this->attachmentsForm = $form;
    }

    /**
     * @return AttachmentsForm
     */
    public function getAttachmentsForm()
    {
        return $this->attachmentsForm;
    }

    private function assertAttachmentsForm()
    {
        if (!$this->getAttachmentsForm()) {
            throw new NullException("Attachments form is not set");
        }
    }

    public function buildForm($formData)
    {
        $this->assertAttachmentsForm();

        $form = $this->getAttachmentsForm();

        // (!empty($formData)) ? $form->addInputFileNotRequired() : $form->addInputFile();

        if (empty($formData)) {
            $form->addInputFile();
        }

        $form->addSecondaryFields();

        $this->form = $form;
    }
}
