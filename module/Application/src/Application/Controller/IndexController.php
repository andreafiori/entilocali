<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;
use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\Sezioni\SezioniGetterWrapper;
use Zend\Session\Container as SessionContainer;

/**
 * Frontend main controller
 * 
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends SetupAbstractController
{
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();
        
        /**
         * @var \Doctrine\ORM\EntityManager $entityManager
         */
        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            return $this->redirect()->toRoute('password-preview'); // login to preview form
        }

        $sezioniWrapper = new SezioniGetterWrapper( new SezioniGetter($entityManager) );
        $sezioniWrapper->setInput( array(
                'orderBy'   => 'sezioni.posizione ASC',
                'attivo'    => 1,
            )
        );
        $sezioniWrapper->setupQueryBuilder();
        $sezioniRecords = $sezioniWrapper->addSottoSezioni(
            $sezioniWrapper->getRecords(),
            array('attivo' => 1)
        );
        
        $sezioni = array();
        foreach($sezioniRecords as $sezione) {
            $sezioni[$sezione['colonna']][] = $sezione;
        }

        $routerManager = new RouterManager($configurations);
        $routerManager->setIsBackend(0);
        $routerManager->setRouteMatchName($appServiceLoader->recoverServiceKey('moduleConfigs', 'fe_router'));

        $input = array_merge(
            $configurations,
            $this->getUserInterfaceConfigurationsArray(),
            $appServiceLoader->getProperties(),
            array(
                'category'  => trim($this->params()->fromRoute('category')),
                'title'     => trim($this->params()->fromRoute('title')),
            )
        );
        
        $routerManagerHelper = new RouterManagerHelper($routerManager->setupRouteMatchObjectInstance());
        $routerManagerHelper->getRouterManger()->setInput($input);
        $routerManagerHelper->getRouterManger()->setupRecord();
        
        $varsFromModel = $routerManagerHelper->getRouterManger()->getOutput('export');
        $varsToExport = array_merge(
                $varsFromModel,
                $input
        );

        $this->layout()->setVariables($varsToExport);

        $serverVars = $this->getRequest()->getServer();

        $templateDir = 'frontend/projects/'.$configurations['project_frontend'].'templates/'.$configurations['template_frontend'];
        if (isset($varsFromModel['basiclayout'])) {
            $basicLayout = $templateDir.$varsFromModel['basiclayout'];
        } else {
            $basicLayout = $input['basiclayout'];
        }

        $this->layout()->setVariables($configurations);
        $this->layout()->setVariables( array(
            'sezioni'               => $sezioni,
            'templateDir'           => $templateDir,
            'maindata'              => $routerManagerHelper->getRouterManger()->getRecords(),
            'preloadResponse'       => isset($input['preloadResponse']) ? $input['preloadResponse'] : null,
            'currentUrl'            => "http://".$serverVars["SERVER_NAME"].$serverVars["REQUEST_URI"],
            'currentDateTime'       => date("Y-m-d H:i:s"),
            'templatePartial'       => $input['template_path'].$routerManagerHelper->getRouterManger()->getTemplate(),
            'cssName'               => $sessionContainer->offSetGet('cssName'),
            'passwordPreviewArea'   => $this->hasPasswordPreviewArea($configurations),
            'renderer'              => $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer')
        ));
        $this->layout($basicLayout);

        return new ViewModel();
    }
}
