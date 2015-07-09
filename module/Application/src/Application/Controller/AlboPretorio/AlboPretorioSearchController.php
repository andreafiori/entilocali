<?php

namespace Application\Controller\AlboPretorio;

use Application\Controller\SearchControllerAbstract;
use ModelModule\Model\AlboPretorio\AlboPretorioFormSearch;
use ModelModule\Model\AlboPretorio\AlboPretorioFormSearchInputFilter;
use Zend\Session\Container as SessionContainer;

/**
 * Set Albo Pretorio search session
 */
class AlboPretorioSearchController extends SearchControllerAbstract
{
    const sessionIdentifier = 'alboPretorioSessionSearch';

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

            $inputFilter = new AlboPretorioFormSearchInputFilter();

            $formSearch = new AlboPretorioFormSearch();
            $formSearch->setBindOnValidate(false);
            $formSearch->addYears();
            /* $formSearch->addSezioni( $helper->formatForDropwdown($sezioniRecords, 'id', 'nome') ); */
            $formSearch->addCheckExpired();
            $formSearch->addSubmitButton();
            $formSearch->addResetButton();
            $formSearch->addCsrf();
            $formSearch->setInputFilter($inputFilter->getInputFilter());
            $formSearch->setData($post);
            if ($formSearch->isValid()) {
                $inputFilter->exchangeArray( $formSearch->getData() );

                $formSearch->setData($post);

                $sessioContainer = new SessionContainer();
                $sessioContainer->offsetSet(self::sessionIdentifier, array(
                    'numero_progressivo' => ($inputFilter->numero_progressivo!=0) ? $inputFilter->numero_progressivo : null,
                    'numero_atto'        => ($inputFilter->numero_atto!=0) ? $inputFilter->numero_atto : null,
                    'testo'              => $inputFilter->testo,
                    'mese'               => $inputFilter->mese,
                    'anno'               => $inputFilter->anno,
                    'sezione'            => $inputFilter->sezione,
                    'expired'            => $inputFilter->expired,
                ));

                $referer = $this->getRequest()->getHeader('Referer');
                if ( is_object($referer) ) {
                    return $this->redirect()->toUrl( $referer->getUri() );
                }
            }

            $mainLayout = $this->initializeFrontendWebsite();

            $referer = $this->getRequest()->getHeader('Referer');
            $alboUrl = $this->url()->fromRoute('albo-pretorio');
            $refererUrl = (is_object($referer)) ? $referer->getUri() : $alboUrl;

            $this->layout()->setVariables(array(
                'formMessages'      => $formSearch->getMessages(),
                'refererUrl'        => $refererUrl,
                'moduleUrl'         => $alboUrl,
                'moduleLabel'       => "Albo pretorio",
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