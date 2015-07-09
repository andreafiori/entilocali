<?php

namespace Application\Controller\AttiConcessione;

use Application\Controller\SearchControllerAbstract;
use ModelModule\Model\AttiConcessione\AttiConcessioneFormSearch;
use ModelModule\Model\AttiConcessione\AttiConcessioneFormSearchInputFilter;
use Zend\Session\Container as SessionContainer;

/**
 * Atti Concessione Form Search destination controller
 */
class AttiConcessioneSearchController extends SearchControllerAbstract
{
    const sessionIdentifier = 'attiConcessioneSessionSearch';

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

            $inputFilter = new AttiConcessioneFormSearchInputFilter();

            $formSearch = new AttiConcessioneFormSearch();
            $formSearch->addMainElements();
            // $formSearch->addAnno(array());
            // $formSearch->addUfficio(array());
            $formSearch->setInputFilter($inputFilter->getInputFilter());
            $formSearch->setData($post);
            if ($formSearch->isValid()) {
                $inputFilter->exchangeArray( $formSearch->getData() );

                $formSearch->setData($post);

                $sessioContainer = new SessionContainer();
                $sessioContainer->offsetSet(self::sessionIdentifier, array(
                    'anno'          => ($inputFilter->anno!=0) ? $inputFilter->anno : null,
                    'codice'        => ($inputFilter->codice) ? $inputFilter->codice : null,
                    'beneficiario'  => ($inputFilter->beneficiario) ? $inputFilter->beneficiario : null,
                    'importo'       => ($inputFilter->importo!=0) ? $inputFilter->importo : null,
                    'settore'       => ($inputFilter->settore) ? $inputFilter->settore : null,
                ));

                $referer = $this->getRequest()->getHeader('Referer');
                if ( is_object($referer) ) {
                    return $this->redirect()->toUrl( $referer->getUri() );
                }
            }

            $mainLayout = $this->initializeFrontendWebsite();

            $referer = $this->getRequest()->getHeader('Referer');
            $moduleUrl = $this->url()->fromRoute('atti-concessione');
            $refererUrl = (is_object($referer)) ? $referer->getUri() : $moduleUrl;

            $this->layout()->setVariables(array(
                'formMessages'      => $formSearch->getMessages(),
                'refererUrl'        => $refererUrl,
                'moduleUrl'         => $moduleUrl,
                'moduleLabel'       => "Atti di concessione",
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
}