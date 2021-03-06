<?php

namespace Application\Controller\Blogs;

use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ModelModule\Model\Posts\PostsFormSearch;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Slugifier;

class BlogsController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $lang = $this->params()->fromRoute('lang');
        $page = $this->params()->fromRoute('page');
        $perPage = $this->params()->fromRoute('perpage');
        $category = $this->params()->fromRoute('category');

        $helper = new PostsControllerHelper();
        $categoriesRecords = $helper->recoverWrapperRecords(
            new PostsCategoriesGetterWrapper(new PostsCategoriesGetter($em)),
            array(
                'languageAbbr'  => $lang,
                'orderBy'       => '',
            )
        );
        $categoriesRecordsForDropDown = $helper->formatForDropwdown($categoriesRecords, 'id', 'name');

        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new PostsGetterWrapper(new PostsGetter($em)),
            array(
                'moduleCode'        => 'blogs',
                'categorySlug'      => $category,
                'languageAbbr'      => $lang,
                'orderBy'           => 'p.id DESC',
            ),
            $page,
            $perPage
        );
        $wrapper->setEntityManager($em);

        $records = $wrapper->addAttachmentsToPaginatorRecords(
            $wrapper->setupRecords(),
            array(
                'moduleId'              => ModulesContainer::blogs,
                'noScaduti'             => 1,
                'languageAbbreviation'  => $lang,
                'orderBy'               => 'a.position'
            )
        );

        $paginator = $wrapper->getPaginator();

        if (!empty($categoriesRecordsForDropDown)) {
            $formSearch = new PostsFormSearch();
            $formSearch->addCategories($categoriesRecordsForDropDown);
            $formSearch->addSubmitButton();
        }

        $this->layout()->setVariables(array(
            'records'           => $records,
            'paginator'         => $paginator,
            'item_count'        => $paginator->getTotalItemCount(),
            'category'          => $category,
            'formSearch'        => (!empty($formSearch)) ? $formSearch : null,
            'categoryName'      => Slugifier::deSlugify($category),
            'mediaDir'          => isset($configurations['media_dir']) ? $configurations['media_dir'] : null,
            'mediaProject'      => isset($configurations['media_project']) ? $configurations['media_project'] : null,
            'templatePartial'   => 'posts/blogs/list.phtml'
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Blog post details
     *
     * @throws \ModelModule\Model\NullException
     */
    public function detailsAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $configurations = $this->layout()->getVariable('configurations');

        $category = $this->params()->fromRoute('category');
        $languageSelection = $this->params()->fromRoute('languageSelection');
        $title = $this->params()->fromRoute('title');

        $wrapper = new PostsGetterWrapper(new PostsGetter($em));
        $wrapper->setInput(array(
            'moduleCode'   => 'blogs',
            'categorySlug' => $category,
            'slug'         => $title,
            'languageAbbr' => $languageSelection,
            'limit'        => 1,
        ));
        $wrapper->setupQueryBuilder();

        $records = $wrapper->getRecords();

        if (!empty($records)) {
            $singleRecord = $records[0];
            $categoryName = $this->params()->fromRoute('category');
            $title        = $singleRecord['title'];
        }

        $this->layout()->setVariables(array(
            'categorySlug'      => $category,
            'titleSlug'         => $title,
            'categoryName'      => !empty($categoryName) ? $categoryName : null,
            'title'             => !empty($title) ? $title : null,
            'record'            => !empty($singleRecord) ? $singleRecord : null,
            'mediaDir'          => isset($configurations['media_dir']) ? $configurations['media_dir'] : null,
            'mediaProject'      => isset($configurations['media_project']) ? $configurations['media_project'] : null,
            'templatePartial'   => 'posts/blogs/details.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}