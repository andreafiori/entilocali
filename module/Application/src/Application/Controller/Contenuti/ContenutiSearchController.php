<?php

namespace Application\Controller\Contenuti;

use Application\Controller\SearchControllerAbstract;
use ModelModule\Model\Contenuti\ContenutiFormSearch;
use ModelModule\Model\Contenuti\ContenutiFormSearchInpuFilter;
use Zend\Session\Container as SessionContainer;

/**
 * Contenuti Search Controller
 */
class ContenutiSearchController extends SearchControllerAbstract
{
    const sessionIdentifier = 'contenutiSessionSearch';

    /**
     * Set search session
     *
     * @return \Zend\Http\Response
     */
    public function indexAction()
    {
        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();

            $post = $request->getPost()->toArray();

            $inputFilter = new ContenutiFormSearchInpuFilter();

            $formSearch = new ContenutiFormSearch();
            $formSearch->addAnno();
            //$formSearch->addInHome();
            //$formSearch->addSottosezioni();
            $formSearch->addCheckExpired();

            $formSearch->setData($post);

            if ($formSearch->isValid()) {
                $inputFilter->exchangeArray( $formSearch->getData() );

                $sessioContainer = new SessionContainer();
                $sessioContainer->offsetSet(self::sessionIdentifier, array(
                    'testo'         => $inputFilter->testo,
                    'sottosezioni'  => $inputFilter->sottosezioni,
                    'inhome'        => $inputFilter->inhome,
                ));

                $referer = $this->getRequest()->getHeader('Referer');
                if ( is_object($referer) ) {
                    return $this->redirect()->toUrl( $referer->getUri() );
                }
            }

            $mainLayout = $this->initializeFrontendWebsite();
            $moduleUrl = $this->url()->fromRoute('main', array('lang' => 'it'));
            $referer = $this->getRequest()->getHeader('Referer');
            $refererUrl = (is_object($referer)) ? $referer->getUri() : $moduleUrl;
            $this->layout()->setVariables(array(
                'formMessages'      => $formSearch->getMessages(),
                'refererUrl'        => $refererUrl,
                'moduleUrl'         => $moduleUrl,
                'moduleLabel'       => "Contenuti",
                'templatePartial'   => 'form-message.phtml',
            ));
var_dump($formSearch->getInputFilter()->getMessages());
            $this->layout()->setTemplate($mainLayout);

        } else {

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }

            return $this->redirect()->toRoute('main');
        }
    }
}