<?php

namespace Admin\Controller\Blogs;

use ModelModule\Model\Languages\LanguagesFormSearch;
use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsFormSearch;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Modules\ModulesContainer;

class BlogsSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $entityManager  = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations     = $this->layout()->getVariable('configurations');
        $lang               = $this->params()->fromRoute('lang');
        $languageSelection  = $this->params()->fromRoute('languageSelection');
        $page               = $this->params()->fromRoute('page');
        $perPage            = $this->params()->fromRoute('perpage');

        try {
            $helper = new PostsControllerHelper();
            $categoriesRecords = $helper->recoverWrapperRecords(
                new PostsCategoriesGetterWrapper(new PostsCategoriesGetter($entityManager)),
                array(
                    'fields'        => 'category.id, category.name',
                    'orderBy'       => 'category.name',
                    'moduleCode'    => 'blogs',
                )
            );
            $helper->checkRecords($categoriesRecords, 'Nessuna categoria presente');
            $wrapperBlogPosts = $helper->recoverWrapperRecordsPaginator(
                new PostsGetterWrapper(new PostsGetter($entityManager)),
                array(
                    'moduleCode' => 'blogs',
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
            $postsRecords = $wrapperBlogPosts->setupRecords();
            $helper->checkRecords($postsRecords, 'Nessun blog post in archivio');

            /* Add attachment files to the recordset */
            $wrapperBlogPosts->setEntityManager($entityManager);
            $postsRecords = $wrapperBlogPosts->addAttachmentsFromRecords(
				$postsRecords,
				array(
					'moduleId' => ModulesContainer::blogs,
				)
			);

            foreach($postsRecords as &$postsRecord) {
                $wrapper = new PostsGetterWrapper( new PostsGetter($entityManager) );
                $wrapper->setInput(array(
                    'fields'     => 'c.id, c.name',
                    'id'         => $postsRecord['id'],
                    'orderBy'    => 'c.name',
                ));
                $wrapper->setupQueryBuilder();

                $postsRecord['categories'] = $wrapper->getRecords();
            }

            $paginator = $wrapperBlogPosts->getPaginator();

            $isMultiLanguage = !empty($configurations['isMultiLanguage']);
            if ($isMultiLanguage==1) {
                $helper->setLanguagesGetterWrapper(new LanguagesGetterWrapper(new LanguagesGetter($entityManager)));

                $formLanguage = $helper->setupLanguageFormSearch(
                    new LanguagesFormSearch(),
                    array('status' => 1),
                    $languageSelection
                );
            }

            $form = new PostsFormSearch();
            $form->addCategories( $helper->formatForDropwdown($categoriesRecords, 'id', 'name') );
            $form->addSubmitButton();

            $this->layout()->setVariables(array(
                'tableTitle'        => 'Blogs',
                'tableDescription'  => $paginator->getTotalItemCount().' posts in archivio',
                'columns' => array(
                    "Immagine",
                    "Titolo",
                    "Categorie",
                    "Inserita da",
                    "Date",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;"
                ),
                'paginator'         => $paginator,
                'records'           => $this->formatColumnRecords($postsRecords),
                'formSearch'        => $form,
                'formLanguage'      => !empty($formLanguage) ? $formLanguage : null,
                'formLanguageAction' => $this->url()->fromRoute('admin/blogs-operations', array(
                    'action'            => 'switchlanguage',
                    'lang'              => $lang,
                    'languageSelection' => $languageSelection,
                )),
                'templatePartial'   => 'datatable/datatable_blogs.phtml',
            ));

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                'messageText'       => $e->getMessage(),
                'templatePartial'   => 'message-exception.phtml',
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * Format recordset to view on table
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

                $imageThumbsPath = $this->layout()->getVariable('basePath').$configurations['media_dir'].$configurations['media_project'].'blogs/thumbs/'.$record['image'];
                $imageBigPath = str_replace('thumbs', 'big', $imageThumbsPath);

                $recordsToReturn[] = array(
                    ($record['image']) ? array(
                        'type'  => 'image',
                        'src'   => $imageThumbsPath,
                        'href'  => $imageBigPath,
                        'title' => 'Image desc',
                    ) : '&nbsp;',
                    $record['title'],
                    $categoryToPrint,
                    // TAGS ROW...
                    $record['userName'].' '.$record['userSurname'],
                    "<strong>Inserito il:</strong> ".date("d-m-Y", strtotime($record['createDate'])).
                    "<br><br><strong>Ultima modifica:</strong> ".date("d-m-Y", strtotime($record['lastUpdate'])),
                    array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/blogs-form', array(
                            'lang'              => $lang,
                            'languageSelection' => $languageSelection,
                            'formtype'          => 'blogs',
                            'id'                => $record['id'],
                        )),
                        'title' => 'Modifica post'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'title'     => 'Elimina post',
                        'href'      => $this->url()->fromRoute('admin/blogs-delete', array(
                            'lang'              => $lang,
                            'languageSelection' => $languageSelection,
                            'page'              => isset($page) ? $page : 1,
                            'formtype'          => 'blogs',
                            'id'                => $record['id'],
                        )),
                        'data-id'   => $record['id']
                    ),
                    array(
                        'type' => 'attachButton',
                        'href' => $this->url()->fromRoute('admin/attachments-summary', array(
                            'lang'          => $lang,
                            'module'        => 'blogs',
                            'referenceId'   => $record['id'],
                        )),
                        'attachmentsFilesCount' => isset($record['attachments']) ? count($record['attachments']) : 0,
                    ),
                );
            }

            return $recordsToReturn;
        }
}