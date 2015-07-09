<?php

namespace Application\Controller;

use Zend\Session\Container as SessionContainer;

/**
 * Form search operations abstract controller
 */
abstract class SearchControllerAbstract extends SetupAbstractController
{
    /**
     * Unset session search
     *
     * @return \Zend\Http\Response
     */
    public function unsetsearchAction()
    {
        $sessionIdentifier = get_class($this);

        $sessioContainer = new SessionContainer();
        $sessioContainer->offsetUnset($sessionIdentifier::sessionIdentifier);

        $referer = $this->getRequest()->getHeader('Referer');
        if ( is_object($referer) ) {
            return $this->redirect()->toUrl( $referer->getUri() );
        }

        return $this->redirect()->toRoute('main');
    }
}