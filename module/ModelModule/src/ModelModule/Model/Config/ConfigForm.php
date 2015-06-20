<?php

namespace ModelModule\Model\Config;

use Zend\Form\Form;

class ConfigForm extends Form
{
    public function addMainConfigs()
    {
        $this->add(array(
            'name' => 'sitename',
            'type' => 'Text',
            'options' => array('label' => '* Nome sito'),
            'attributes' => array(
                'title'         => 'Inserisci nome sito',
                'id'            => 'sitename',
                'placeholder'   => 'Nome sito...',
                'required'      => 'required',
            )
        ));

        $this->add(array(
            'name' => 'description',
            'type' => 'Textarea',
            'options' => array('label' => '* Descrizione'),
            'attributes' => array(
                'title'         => 'Inserisci descrizione sito',
                'id'            => 'description',
                'placeholder'   => 'Descrizione...',
                'required'      => 'required',
                'rows'          => 5
            )
        ));

        $this->add(array(
            'name' => 'keywords',
            'type' => 'Textarea',
            'options' => array('label' => '* Parole chiave (separate da virgola)'),
            'attributes' => array(
                'title'         => 'Inserisci parole chiave sito',
                'id'            => 'keywords',
                'placeholder'   => 'Parole chiave...',
                'required'      => 'required',
                'rows'          => 5
            )
        ));

        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'paginationLabel',
            'attributes' => array(
                'id'    => 'searchEngines',
                'value' => 'Paginazione',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'name' => 'prodperpage',
            'type' => 'Text',
            'options' => array('label' => '* Elementi per pagina'),
            'attributes' => array(
                'title'         => 'Inserisci email form contatti',
                'id'            => 'prodperpage',
                'placeholder'   => 'Email contatto...',
                'required'      => 'required',
                'type'          => 'number'
            )
        ));
    }

    public function addContrattiPubblici()
    {
        /*
         contratti_pubblici_basiclayout
         amministrazione_trasparente_basiclayout
         atti_concessione_basiclayout
        */
    }

    public function addEmails()
    {
        $this->add(array(
            'name' => 'emailcontact',
            'type' => 'Text',
            'options' => array('label' => '* E-mail form contatti'),
            'attributes' => array(
                'title'         => 'Inserisci email form contatti',
                'id'            => 'emailcontact',
                'placeholder'   => 'Email contatto...',
                'required'      => 'required',
            )
        ));

        $this->add(array(
            'name' => 'emailnoreply',
            'type' => 'Text',
            'options' => array('label' => '* E-mail noreplyi'),
            'attributes' => array(
                'title'         => 'Inserisci email noreply',
                'id'            => 'emailnoreply',
                'placeholder'   => 'Email contatto...',
                'required'      => 'required',
            )
        ));

        /* mailwebmaster ? */
    }

    public function addProject()
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'project_label',
            'attributes' => array(
                'id'    => 'project_label',
                'value' => 'Progetto',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'name' => 'projectdir_frontend',
            'type' => 'Text',
            'options' => array('label' => '* Nome cartella progetto sito pubblico'),
            'attributes' => array(
                'title'         => 'Frontend',
                'id'            => 'projectdir_frontend',
                'placeholder'   => 'Nome cartella progetto sito pubblico...',
                'required'      => 'required',
            )
        ));

        /* project_frontend */

        $this->add(array(
            'name' => 'project_backend',
            'type' => 'Text',
            'options' => array('label' => '* Nome cartella progetto admin area'),
            'attributes' => array(
                'title'         => 'Inserisci nome cartella progetto admin area',
                'id'            => 'project_backend',
                'placeholder'   => 'Backend...',
                'required'      => 'required',
            )
        ));
    }

    public function addTemplates()
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'start_date',
            'attributes' => array(
                'id'    => 'searchEngines',
                'value' => 'Templates',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'name' => 'template_frontend',
            'type' => 'Text',
            'options' => array('label' => '* Frontend'),
            'attributes' => array(
                'title'         => 'Inserisci nome template frontend',
                'id'            => 'template_frontend',
                'placeholder'   => 'Frontend...',
                'required'      => 'required',
            )
        ));

        $this->add(array(
            'name' => 'template_backend',
            'type' => 'Text',
            'options' => array('label' => '* Backend'),
            'attributes' => array(
                'title'         => 'Inserisci nome template admin area',
                'id'            => 'template_backend',
                'placeholder'   => 'Backend...',
                'required'      => 'required',
            )
        ));
    }

    public function addPasswordPreviewArea()
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'start_date',
            'attributes' => array(
                'id'    => 'searchEngines',
                'value' => 'Preview password area',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'start_date',
            'attributes' => array(
                'id'    => 'searchEngines',
                'value' => "Area password anteprima sito. Utile per non far visualizzare il progetto a tutti gli utenti se ancora in lavorazione",
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ufficioResponsabile',
            'options' => array(
                'label'          => 'Password preview area',
                'empty_option'   => 'Seleziona',
                'value_options'  => array(
                    0 => 'Disattivata',
                    1 => 'Attiva'
                ),
            ),
            'attributes' => array(
                'id'        => 'ufficioResponsabile',
                'title'     => 'Seleziona Ufficio Responsabile',
                'required'  => 'required',
            )
        ));

        $this->add(array(
            'name' => 'preview_password',
            'type' => 'Password',
            'options' => array('label' => 'Password'),
            'attributes' => array(
                'title'         => 'Inserisci Preview Password Area',
                'id'            => 'preview_password',
                'placeholder'   => 'Password area...',
            )
        ));
    }

    public function addAmazonS3Fields()
    {
        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'start_date',
            'attributes' => array(
                'id'    => 'searchEngines',
                'value' => 'Amazon S3',
                'type'  => 'PlainTextTitle'
            ),
        ));

        $this->add(array(
            'type' => 'Application\Form\Element\PlainText',
            'name' => 'start_date',
            'attributes' => array(
                'id'    => 'searchEngines',
                'value' => 'Amazon S3, parametri di connessione',
            ),
        ));

        $this->add(array(
            'name' => 'amazon_s3_bucket',
            'type' => 'Text',
            'options' => array('label' => '* Bucket'),
            'attributes' => array(
                'title'         => 'Bucket',
                'id'            => 'amazon_s3_bucket',
                'placeholder'   => 'Bucket...',
                'required'      => 'required',
            )
        ));

        $this->add(array(
            'name' => 'amazon_s3_accesskey',
            'type' => 'Text',
            'options' => array('label' => '* Amazon accesskey'),
            'attributes' => array(
                'title'         => 'Amazon accesskey',
                'id'            => 'amazon_s3_accesskey',
                'placeholder'   => 'Amazon accesskey...',
                'required'      => 'required',
            )
        ));

        $this->add(array(
            'name' => 'amazon_s3_secretkey',
            'type' => 'Text',
            'options' => array('label' => '* Secret key'),
            'attributes' => array(
                'title'         => 'Inserisci Amazon Secret Key',
                'id'            => 'amazon_s3_secretkey',
                'placeholder'   => 'Email contatto...',
                'required'      => 'required',
            )
        ));

        /* attachsizelimit */
    }
}