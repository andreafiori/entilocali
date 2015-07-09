<?php

namespace Application\Controller\ContrattiPubblici;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormSearch;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormSearchInputFilter;
use Zend\Session\Container as SessionContainer;

class ContrattiPubbliciSearchController extends SetupAbstractController
{
    const sessionIdentifier = 'contrattiPubbliciSessionSearch';

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

            $inputFilter = new ContrattiPubbliciFormSearchInputFilter();

            $formSearch = new ContrattiPubbliciFormSearch();
            $formSearch->setBindOnValidate(false);
            $formSearch->addMainFormElements();
            //$formSearch->addYears(array());
            //$formSearch->addSettori();
            $formSearch->setInputFilter($inputFilter->getInputFilter());
            $formSearch->setData($post);
            if ($formSearch->isValid()) {
                $inputFilter->exchangeArray( $formSearch->getData() );

                $formSearch->setData($post);

                $sessioContainer = new SessionContainer();
                $sessioContainer->offsetSet(self::sessionIdentifier, array(
                    'anno'      => $inputFilter->anno,
                    'cig'       => $inputFilter->cig,
                    'importo'   => $inputFilter->importo,
                    'settore'   => $inputFilter->settore,
                ));

                $referer = $this->getRequest()->getHeader('Referer');
                if ( is_object($referer) ) {
                    return $this->redirect()->toUrl( $referer->getUri() );
                }
            }
var_dump($formSearch->getInputFilter()->getMessages());
            $mainLayout = $this->initializeFrontendWebsite();

            $referer = $this->getRequest()->getHeader('Referer');
            $alboUrl = $this->url()->fromRoute('contratti-pubblici');
            $refererUrl = (is_object($referer)) ? $referer->getUri() : $alboUrl;

            $this->layout()->setVariables(array(
                'formMessages'      => $formSearch->getMessages(),
                'refererUrl'        => $refererUrl,
                'moduleUrl'         => $alboUrl,
                'moduleLabel'       => "Bandi di gara e contratti",
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