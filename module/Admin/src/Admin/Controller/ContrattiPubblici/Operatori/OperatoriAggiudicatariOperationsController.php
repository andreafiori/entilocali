<?php

namespace Admin\Controller\ContrattiPubblici\Operatori;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariControllerHelper;

class OperatoriAggiudicatariOperationsController extends SetupAbstractController
{
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
            $helper->updateAggiudicatario($post['idRelation'], $post['idContratto']);

            return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );

        } catch(\Exception $e) {
            // TODO: render message template with error...
        }
    }

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
            $helper->deleteRelation(isset($post['idRelation']) ? $post['idRelation'] : null);

            return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );

        } catch(\Exception $e) {
            // TODO: render message template with error...
        }
    }

    /**
     * Remove single partecipante
     *
     * @return \Zend\Http\Response
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    public function removepartecipanteAction()
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
            $helper->deleteRelation(isset($post['idRelation']) ? $post['idRelation'] : null);

            return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );

        } catch(\Exception $e) {
            // TODO: render message template with error...
        }
    }
}