<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Frontend Main Controller
 * 
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $commonSetupPlugin  = $this->CommonSetupPlugin();
        $configurations     = $commonSetupPlugin->recoverConfigurationsRecord();
        
        switch($configurations['routeMatchName'])
        {
           default:
                if ( trim($this->params()->fromRoute('category')) or trim($this->params()->fromRoute('title')) ) {
                    
                    $serviceLocator = $this->getServiceLocator();
                    $queryBuilder = $serviceLocator->get('Doctrine\ORM\EntityManager');
 
                    $input = array(
                        'titolo'         => $this->params()->fromRoute('title'),
                        'nome_categoria' => $this->params()->fromRoute('category')
                    );
                    
                    $postsGetterWrapper = new \Application\Model\Posts\PostsGetterWrapper( new \Application\Model\Posts\PostsGetter($queryBuilder) );
                    $postsGetterWrapper->setInput($input);
                    $mainControllerResponse = $postsGetterWrapper->getRecords();
                    
                    if ( isset($mainControllerResponse['template']) ) {
                        $templatePartial = $mainControllerResponse['template'];
                    }
                    
                    $templatePartial = 'content/details.phtml'; // this is a trial, DELETE THIS!!!
                }

                if ( !isset($templatePartial) ) {
                   $templatePartial = 'homepage.phtml';
                }
            break;

            case("albo-pretorio"):
                $templatePartial = 'albo-pretorio/index.phtml';
            break;

            case("foto"):
                $mainControllerResponse = json_encode( array() );
                $templatePartial = 'foto/index.phtml';
            break;

            case("amministrazione-aperta"):
                $templatePartial = 'amministrazione-aperta/index.phtml';
            break;

            case("amministrazione-trasparente"):
                $templatePartial = 'amministrazione-trasparente/index.phtml';
            break;

            case("stato-civile"):
                $templatePartial = 'stato-civile/index.phtml';
            break;
       
            case("contatti"):
                $form    = new \Application\Form\ContactForm();
                $request = $this->getRequest();

                if ( $request->isPost() ) {
                    
                    $form->setInputFilter( new \Application\Form\ContactFormValidator() );
                    $request = $this->getRequest();

                    if ($request->isPost()) {
                        $form->setData($request->getPost());
                        if ($form->isValid()) {
                           
                        } else {
                            foreach ($form->getInputFilter()->getInvalidInput() as $invalidInput) {
                                //echo $invalidInput->getName() . ': ' . 
                                //implode(',',$invalidInput->getMessages()) . '<br/>';
                            }
                        }
                    }
                }

                $this->layout()->setVariable('form', $form);
                $templatePartial = 'contatti/index.phtml';
            break;
            
            case("form-response"):
                $templatePartial = 'stato-civile/index.phtml';
            break;
        }

        foreach($configurations as $key => $value) {
            $this->layout()->setVariable($key, $value);
        }
        
        if ( isset($mainControllerResponse) ) {
            $this->layout()->setVariable('maindata', $mainControllerResponse);
        }
        
        $this->layout()->setVariable('preloadResponse', $configurations['preloadResponse']);
        $this->layout()->setVariable('templatePartial', $configurations['template_path'].$templatePartial);
        $this->layout($configurations['basiclayout']);
        
        return new ViewModel();
    }
    
}
