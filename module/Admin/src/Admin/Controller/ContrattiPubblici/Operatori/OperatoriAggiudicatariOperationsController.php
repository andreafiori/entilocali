<?php

namespace Admin\Controller\ContrattiPubblici\Operatori;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariControllerHelper;

/**
 * Aziende OperatoriAggiudicatari Operations Controller
 */
class OperatoriAggiudicatariOperationsController extends SetupAbstractController
{
    /**
     * @return mixed
     */
    public function addoperatoreAction()
    {
        $request = $this->getRequest();

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $em->getConnection();

        $helper = new OperatoriAggiudicatariControllerHelper();
        $helper->setEntityManager($em);
        $helper->setConnection($connection);

        try {
            foreach($post['operatorerubrica'] as $partecipante) {
                $helper->addOperatore($partecipante, $this->params()->fromRoute('id'));
            }
        } catch (\Exception $e) {

        }

        return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );
    }

    /**
     * TODO: render message template with error
     *
     * @return \Zend\Http\Response
     */
    public function addaggiudicatarioAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $em->getConnection();

        $helper = new OperatoriAggiudicatariControllerHelper();
        try {

            $helper->setEntityManager($em);
            $helper->setConnection($connection);
            $helper->updateAggiudicatario($post['idRelation'], 1);

            return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );

        } catch(\Exception $e) {

        }
    }

    /**
     * TODO: render message template with error
     *
     * @return mixed
     */
    public function removeAggiudicatarioAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $em->getConnection();

        $helper = new OperatoriAggiudicatariControllerHelper();
        try {

            $helper->setEntityManager($em);
            $helper->setConnection($connection);
            $helper->updateAggiudicatario($post['idRelation'], 0);

            return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );

        } catch(\Exception $e) {

        }
    }

    /**
     * TODO: render message template with error
     *
     * Remove single partecipante and redirect to summary
     *
     * @return \Zend\Http\Response
     */
    public function removepartecipanteAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $helper = new OperatoriAggiudicatariControllerHelper();
        try {

            $helper->setEntityManager($em);
            $helper->setConnection($connection);
            $helper->deleteRelation(isset($post['idRelation']) ? $post['idRelation'] : null);

            return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );

        } catch(\Exception $e) {

        }
    }

    /**
     * Update gruppo and redirect
     *
     * @return mixed
     */
    public function updateGruppoAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        try {
            $helper = new OperatoriAggiudicatariControllerHelper();
            $helper->setEntityManager($em);
            $helper->setConnection($connection);
            $helper->updateGruppo($post['gruppo'], $post['relationId']);

            $referer = $this->getRequest()->getHeader('Referer');
            if ($referer) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }

        } catch(\Exception $e) {

        }

        return $this->redirect()->toRoute('main');
    }

    /**
     * @return \Zend\Http\Response
     */
    public function updateRuoloAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        try {
            $helper = new OperatoriAggiudicatariControllerHelper();
            $helper->setEntityManager($em);
            $helper->setConnection($connection);
            $helper->updateRole($post['ruolo'], $post['relationId']);

            $referer = $this->getRequest()->getHeader('Referer');
            if ($referer) {
                return $this->redirect()->toUrl( $referer->getUri() );
            }

        } catch(\Exception $e) {

        }

        return $this->redirect()->toRoute('main');
    }
}