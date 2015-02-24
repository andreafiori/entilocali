<?php

namespace Migrazione\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\Database\Redbean\R;
use Zend\View\Model\ViewModel;

/**
 * @author Andrea Fiori
 * @since  26 September 2014
 */
class MigrazioneController extends AbstractActionController
{
    public function indexAction()
    {
        $configFromServiceLocator = $this->getServiceLocator()->get('config');
        
        $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];

        R::setup('mysql:host='.$connectionParams['host'].';dbname='.$connectionParams['dbname'], $connectionParams['user'], $connectionParams['password']);

        $viewModel = new ViewModel();
        $viewModel->setVariables(array(
            'migrationButtons' => array(

                'users' => array(
                    'formId'     => 'userFormMigration',
                    'formAction' => '?op=users',
                    'buttonId'   => 'userMigrationButton',
                    'buttonLabel' => 'Utenti',
                ),

                'config' => array(
                    'formId'      => 'configurationFormMigration',
                    'formAction'  => '?op=config',
                    'buttonId'    => 'configurationMigrationButton',
                    'buttonLabel' => 'Configurazioni',
                ),

                'modules' => array(
                    'formId'      => 'modulesFormMigration',
                    'formAction'  => '?op=modules',
                    'buttonId'    => 'modulesMigrationButton',
                    'buttonLabel' => 'Moduli',
                ),

                'stato-civile' => array(
                    'formId'      => 'statocivileFormMigration',
                    'formAction'  => '?op=stato-civile',
                    'buttonId'    => 'statocivileMigrationButton',
                    'buttonLabel' => 'Stato Civile',
                ),

                'contratti-pubblici' => array(
                    'formId'      => 'contrattiPubbliciFormMigration',
                    'formAction'  => '?op=contratti-pubblici',
                    'buttonId'    => 'contrattiPubbliciMigrationButton',
                    'buttonLabel' => 'Contratti Pubblici',
                ),

                'amministrazione-trasparente' => array(
                    'formId'      => 'amministrazioneTrasparenteFormMigration',
                    'formAction'  => '?op=amministrazione-trasparente',
                    'buttonId'    => 'statocivileMigrationButton',
                    'buttonLabel' => 'Amministrazione trasparente',
                ),

                'albo-pretorio' => array(
                    'formId'      => 'alboPretorioFormMigration',
                    'formAction'  => '?op=albo-pretorio',
                    'buttonId'    => 'alboPretorioMigrationButton',
                    'buttonLabel' => 'Albo pretorio',
                ),

                'enti-terzi' => array(
                    'formId'      => 'entiTerziFormMigration',
                    'formAction'  => '?op=enti-terzi',
                    'buttonId'    => 'entiTerziMigrationButton',
                    'buttonLabel' => 'Enti terzi',
                ),

                'contenuti' => array(
                    'formId'      => 'contenutiFormMigration',
                    'formAction'  => '?op=contenuti',
                    'buttonId'    => 'contenutiMigrationButton',
                    'buttonLabel' => 'Contenuti',
                ),

                'foto' => array(
                    'formId'      => 'fotoFormMigration',
                    'formAction'  => '?op=foto',
                    'buttonId'    => 'fotoMigrationButton',
                    'buttonLabel' => 'Foto',
                ),

                'blogs' => array(
                    'formId'      => 'blogsFormMigration',
                    'formAction'  => '?op=blogs',
                    'buttonId'    => 'blogsMigrationButton',
                    'buttonLabel' => 'Blogs',
                ),

                'forum' => array(
                    'formId'      => 'forumFormMigration',
                    'formAction'  => '?op=forum',
                    'buttonId'    => 'forumMigrationButton',
                    'buttonLabel' => 'Forum',
                ),

                'newsletter' => array(
                    'formId'      => 'newsletterFormMigration',
                    'formAction'  => '?op=newsletter',
                    'buttonId'    => 'newsletterMigrationButton',
                    'buttonLabel' => 'Newsletter',
                ),

                'assistenze' => array(
                    'formId'      => 'assistenzeFormMigration',
                    'formAction'  => '?op=forum',
                    'buttonId'    => 'assistenzeMigrationButton',
                    'buttonLabel' => 'Assistenze',
                ),

                'assistenze' => array(
                    'formId'      => 'assistenzeFormMigration',
                    'formAction'  => '?op=forum',
                    'buttonId'    => 'assistenzeMigrationButton',
                    'buttonLabel' => 'Assistenze',
                ),

                'delete-old-cms' => array(
                    'formId'      => 'deleteOldCMSFormMigration',
                    'formAction'  => '?op=delete-old-cms',
                    'buttonId'    => 'deleteOldCMSMigrationButton',
                    'buttonLabel' => 'Conferma eliminazione',
                ),
            )
        ) );
        
        return $viewModel;
    }
    
    /**
     * Manage migration requests and get the result
     */
    public function operationAction()
    {
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent('Under Construction');
        return $response;
    }
}
