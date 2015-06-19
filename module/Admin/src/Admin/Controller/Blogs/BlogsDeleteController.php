<?php

namespace Admin\Controller\Blogs;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;

class BlogsDeleteController extends SetupAbstractController
{
    public function indexAction()
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $em->getConnection();

        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $mainLayout = $this->initializeAdminArea();

        $configurations = $this->layout()->getVariable('configurations');
        $userDetails = $this->recoverUserDetails();

        $id = $post['deleteId'];

        $helper = new PostsControllerHelper();
        $helper->setEntityManager($em);
        $helper->setConnection($connection);
        $helper->setLoggedUser($userDetails);

        try {

            $records = $helper->recoverWrapperRecordsById(
                new PostsGetterWrapper(new PostsGetter($em)),
                array('id' => $id, 'limit' => 1, 'fields' => 'p.image'),
                $id
            );
            $helper->checkRecords('Dati post corrente non trovati');

            /* Delete images from file system */
            $currentImage = isset($records[0]['image']) ? $records[0]['image'] : null;
            if ($currentImage) {
                $mediaDir = $helper->checkMediaDir($configurations);
                $mediaProject = $helper->checkMediaProject($configurations);

                /* Delete old image */
                $oldImageThumbPath = $mediaDir.$mediaProject.'/blogs/thumbs/'.$currentImage;
                $oldImageBigPath = $mediaDir.$mediaProject.'/blogs/big/'.$currentImage;
                if (file_exists($oldImageThumbPath) and $currentImage!='') {
                    unlink($oldImageThumbPath);
                }
                if (file_exists($oldImageBigPath) and $currentImage!='') {
                    unlink($oldImageBigPath);
                }
            }
            /* Delete Post from database */
            $helper->getConnection()->beginTransaction();
            $helper->delete($id, ModulesContainer::blogs);
            $helper->getConnection()->commit();

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::blogs,
                'message'       => "Eliminato post blog ".$id,
                'type'          => 'info',
                'reference_id'  => $id,
                'backend'       => 1,
            ));

            return $this->redirect()->toUrl($this->url()->fromRoute('admin/blogs-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
                'page'              => $this->params()->fromRoute('page'),
                'modulename'        => $this->params()->fromRoute('modulename'),
            )));

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $exDb) {

            }

            $logWriter = new LogWriter($connection);
            $logWriter->writeLog(array(
                'user_id'       => $userDetails->id,
                'module_id'     => ModulesContainer::blogs,
                'message'       => "Errore eliminazione blog post",
                'type'          => 'error',
                'description'   => $e->getMessage(),
                'reference_id'  => $id,
                'backend'       => 1,
            ));

            $this->layout()->setVariables(array(
                'messageType'           => 'danger',
                'messageTitle'          => 'Errore eliminazione blog post',
                'messageText'           => $e->getMessage(),
                'messageShowFormLink'   => 1,
                'messageShowForm'       => "Torna all'elenco posts",
                'templatePartial'       => 'message.phtml',
            ));

            $this->layout()->setTemplate($mainLayout);
        }
    }
}