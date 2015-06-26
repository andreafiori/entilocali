<?php

namespace Admin\Controller\Photo;

use ModelModule\Model\Posts\CategoriesGetter;
use ModelModule\Model\Posts\CategoriesGetterWrapper;
use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsFormSearch;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use Application\Controller\SetupAbstractController;

class PhotoSummaryController extends SetupAbstractController
{
    /**
     * @throws \ModelModule\Model\NullException
     */
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $helper = new PostsControllerHelper();
        $categoriesRecords = $helper->recoverWrapperRecords(
            new PostsCategoriesGetterWrapper(new PostsCategoriesGetter($em)),
            array(
                'fields'        => 'category.id, category.name',
                'orderBy'       => 'category.name',
                'moduleCode'    => 'photo',
            )
        );
        $helper->checkRecords($categoriesRecords, 'Nessuna categoria presente');
        $wrapperPosts = $helper->recoverWrapperRecordsPaginator(
            new PostsGetterWrapper(new PostsGetter($em)),
            array(
                'moduleCode' => 'photo',
                'userId'     => null,
                'orderBy'    => 'p.id DESC',
                'fields'     => 'DISTINCT(p.id) AS id, p.lastUpdate,
                                    p.createDate, p.expireDate, p.hasAttachments,
                                    p.image, p.title, p.subtitle, p.description, p.slug, p.seoTitle,
                                    p.seoDescription, p.seoKeywords,
                                    users.name AS userName, users.surname AS userSurname'
            ),
            $page,
            $perPage
        );

        /* Add categories to the recordset */
        $postsRecords = $wrapperPosts->setupRecords();
        $helper->checkRecords($postsRecords, 'Nessuna foto in archivio');

        foreach($postsRecords as &$postsRecord) {
            $wrapper = new PostsGetterWrapper(new PostsGetter($em));
            $wrapper->setInput(array(
                'fields'     => 'c.id, c.name',
                'id'         => $postsRecord['id'],
                'orderBy'    => 'c.name',
            ));
            $wrapper->setupQueryBuilder();

            $postsRecord['categories'] = $wrapper->getRecords();
        }

        $form = new PostsFormSearch();
        $form->addCategories( $helper->formatForDropwdown($categoriesRecords, 'id', 'name') );
        $form->addSubmitButton();

        $paginator = $wrapperPosts->getPaginator();

        $postsRecords = $wrapperPosts->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Foto',
            'tableDescription'  => $paginator->getTotalItemCount().' foto in archivio.',
            'paginator'         => $paginator,
            'records'           => $this->formatColumnRecords($postsRecords),
            'columns' => array(
                'Foto',
                "Titolo",
                "Categorie",
                "Inserito da",
                "Date",
                "&nbsp;",
                "&nbsp;",
            ),
            'formSearch'        => $form,
            'templatePartial'   => 'datatable/datatable_photo.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Format recordset for table summary
     *
     * @param mixed $records
     * @return array
     */
    private function formatColumnRecords($records)
    {
        $configurations     = $this->layout()->getVariable('configurations');
        $lang               = $this->params()->fromRoute('lang');
        $languageSelection  = $this->params()->fromRoute('languageSelection');
        $page               = $this->params()->fromRoute('page');

        $recordsToReturn = array();
        foreach($records as $record) {

            $categoryToPrint = '';
            foreach($record['categories'] as $category) {
                $categoryToPrint .= $category['name']."<br>";
            }

            $imageThumbsPath = $this->layout()->getVariable('publicDirRelativePath').'/'.$configurations['media_dir'].$configurations['media_project'].'photo/thumbs/'.$record['image'];
            $imageBigPath = str_replace('thumbs', 'big', $imageThumbsPath);

            $recordsToReturn[] = array(
                array(
                    'type'      => 'image',
                    'src'       => $imageThumbsPath,
                    'href'      => $imageBigPath,
                    'title'     => 'Miniatura foto per '.$record['title'],
                    'img-class' => 'img-thumbnail',
                    'target'    => 'blank',
                ),
                $record['title'],
                $categoryToPrint,
                $record['userName'].' '.$record['userSurname'],
                "<strong>Inserito il:</strong> ".date("d-m-Y", strtotime($record['createDate'])).
                "<br><br><strong>Ultima modifica:</strong> ".date("d-m-Y", strtotime($record['lastUpdate'])),
                array(
                    'type' => 'updateButton',
                    'href' => $this->url()->fromRoute('admin/photo-form', array(
                        'lang'              => $lang,
                        'languageSelection' => $languageSelection,
                        'formtype'          => 'photo',
                        'id'                => $record['id']
                    )),
                    'title' => 'Modifica foto'
                ),
                array(
                    'type'      => 'deleteButton',
                    'title'     => 'Elimina foto',
                    'href'      => $this->url()->fromRoute('admin/photo-delete', array(
                        'lang'              => $lang,
                        'languageSelection' => $languageSelection,
                        'page'              => isset($page) ? $page : 1,
                        'formtype'          => 'photo',
                        'id'                => $record['id'],
                    )),
                    'data-id'   => $record['id']
                ),
            );
        }

        return $recordsToReturn;
    }
}