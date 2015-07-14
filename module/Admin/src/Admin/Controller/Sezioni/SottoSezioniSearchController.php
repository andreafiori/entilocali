<?php

namespace Admin\Controller\Sezioni;

use Application\Controller\SearchControllerAbstract;
use ModelModule\Model\Sezioni\SottoSezioniFormSearch;
use ModelModule\Model\Sezioni\SottoSezioniFormSearchInputFilter;
use Zend\Session\Container as SessionContainer;

/**
 * SottoSezioni Search Controller
 */
class SottoSezioniSearchController extends SearchControllerAbstract
{
    const sessionIdentifier = 'sottosezioniContenuti';

    const sessionIdentifierAmmTrasp = 'sottosezioniAmmTrasp';

    /**
     * @return mixed
     */
    public function indexAction()
    {
        if ($this->getRequest()->isPost()) {

            $request = $this->getRequest();

            $post = $request->getPost()->toArray();

            $inputFilter = new SottoSezioniFormSearchInputFilter();

            $formSearch = new SottoSezioniFormSearch();

            $formSearch->setData($post);

            if ($formSearch->isValid()) {
                $inputFilter->exchangeArray( $formSearch->getData() );

                $sessioContainer = new SessionContainer();
                $sessioContainer->offsetSet(self::sessionIdentifier, array(
                    'testo'         => $inputFilter->testo,
                    'sottosezioni'  => $inputFilter->sezioni,
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