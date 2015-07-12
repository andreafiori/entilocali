<?php

namespace Application\Controller\Posts;

use Admin\src\Admin\Model\Posts\PostsFormSearchInputFilter;
use Application\Controller\SearchControllerAbstract;
use ModelModule\Model\Posts\PostsFormSearch;
use Zend\Session\Container as SessionContainer;

/**
 * Generic posts abstract form searchx
 */
abstract class PostsSearchControllerAbstract extends SearchControllerAbstract
{
    /* const sessionIdentifier = 'postsSessionSearch'; */

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

            $inputFilter = new PostsFormSearchInputFilter();

            $formSearch = new PostsFormSearch();

            $formSearch->setInputFilter($inputFilter->getInputFilter());
            $formSearch->setData($post);

            $currentClass = get_class( $this );
            $sessionIdentifier = $currentClass::sessionIdentifier;

            if ($formSearch->isValid()) {
                $inputFilter->exchangeArray( $formSearch->getData() );

                $formSearch->setData($post);

                $sessioContainer = new SessionContainer();
                $sessioContainer->offsetSet($sessionIdentifier, array(
                    'testo'         => $inputFilter->testo,
                    'categories'    => $inputFilter->category,
                ));

                $referer = $this->getRequest()->getHeader('Referer');
                if ( is_object($referer) ) {
                    return $this->redirect()->toUrl( $referer->getUri() );
                }
            }

            $mainLayout = $this->initializeFrontendWebsite();

            $referer = $this->getRequest()->getHeader('Referer');

            $this->layout()->setVariables(array(
                'formMessages'      => $formSearch->getMessages(),
                'refererUrl'       => is_object($referer) ? $referer->getUri() : null,
                'moduleLabel'       => "Posts",
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