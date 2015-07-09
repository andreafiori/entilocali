<?php

namespace Application\Controller\StatoCivile;

use ModelModule\Model\StatoCivile\StatoCivileFormSearch;
use ModelModule\Model\StatoCivile\StatoCivileFormSearchInputFilter;
use Application\Controller\SetupAbstractController;
use Zend\Session\Container as SessionContainer;

/**
 * Stato Civile search session controller
 */
class StatoCivileSearchController extends SetupAbstractController
{
    const sessionIdentifier = 'statoCivileSessionSearch';

    /**
     * Set search session
     *
     * @return \Zend\Http\Response
     */
    public function indexAction()
    {
        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();

            $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

            $inputFilter = new StatoCivileFormSearchInputFilter();

            $formSearch = new StatoCivileFormSearch();
            $formSearch->setBindOnValidate(false);
            $formSearch->addTesto();
            $formSearch->addMese();
            $formSearch->addAnni();
            /* $formSearch->addSezioni(); */

            $formSearch->setInputFilter($inputFilter->getInputFilter());
            $formSearch->setData($post);
            if ($formSearch->isValid()) {
                $inputFilter->exchangeArray( $formSearch->getData() );

                $formSearch->setData($post);

                $sessioContainer = new SessionContainer();
                $sessioContainer->offsetSet(self::sessionIdentifier, array(
                    'testo'              => $inputFilter->testo,
                    'mese'               => $inputFilter->mese,
                    'anno'               => $inputFilter->anno,
                    'sezione'            => $inputFilter->sezione,
                ));

                $referer = $this->getRequest()->getHeader('Referer');
                if ( is_object($referer) ) {
                    return $this->redirect()->toUrl( $referer->getUri() );
                }
            }

            $mainLayout = $this->initializeFrontendWebsite();

            $referer = $this->getRequest()->getHeader('Referer');
            $alboUrl = $this->url()->fromRoute('stato-civile');
            $refererUrl = (is_object($referer)) ? $referer->getUri() : $alboUrl;

            $this->layout()->setVariables(array(
                'formMessages'      => $formSearch->getMessages(),
                'refererUrl'        => $refererUrl,
                'moduleUrl'         => $alboUrl,
                'moduleLabel'       => "Stato civile",
                'templatePartial'   => 'form-message.phtml',
            ));

            $this->layout()->setTemplate($mainLayout);

        } else {

            $referer = $this->getRequest()->getHeader('Referer');
            if ( is_object($referer) ) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }

            return $this->redirect()->toRoute('main');
        }
    }

    /**
     * Unset session search
     *
     * @return \Zend\Http\Response
     */
    public function unsetsearchAction()
    {
        $sessioContainer = new SessionContainer();
        $sessioContainer->offsetUnset(self::sessionIdentifier);

        $referer = $this->getRequest()->getHeader('Referer');
        if ( is_object($referer) ) {
            return $this->redirect()->toUrl( $referer->getUri() );
        }

        return $this->redirect()->toRoute('main');
    }
}