<?php

namespace Application\Controller\SearchEngine;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ModelModule\Model\SearchEngine\SearchEngineControllerHelper;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * TODO: let the selection add attachments and other related records
 */
abstract class SearchEngineAbstractController extends SetupAbstractController
{
    /**
     * Following POST request, return the recrds
     *
     * @param $post
     */
    protected function recoverSearchRecords($post, $page = 1, $perPage = null)
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new SearchEngineControllerHelper();

        $helper->setupSearchRecordsWithPaginator(
            $helper->recoverWrapperRecordsPaginator(
                new ContenutiGetterWrapper(new ContenutiGetter($em)),
                array('freeSearch' => $post['searchtext']),
                $page,
                $perPage
            ),
            'contenuti' /* NOTE: same as Amm. Trasparente */
        );

        $helper->setupSearchRecordsWithPaginator(
            $helper->recoverWrapperRecordsPaginator(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array('freeSearch' => $post['searchtext']),
                $page,
                $perPage
            ),
            'contratti-pubblici'
        );

        $helper->setupSearchRecordsWithPaginator(
            $helper->recoverWrapperRecordsPaginator(
                new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
                array('textSearch' => $post['searchtext']),
                1,
                null
            ),
            'stato-civile'
        );

        $helper->setupSearchRecordsWithPaginator(
            $helper->recoverWrapperRecordsPaginator(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                array('freeSearch' => $post['searchtext']),
                $page,
                $perPage
            ),
            'albo-pretorio'
        );

        $helper->setupSearchRecordsWithPaginator(
            $helper->recoverWrapperRecordsPaginator(
                new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
                array('freeSearch' => $post['searchtext']),
                $page,
                $perPage
            ),
            'atti-concessione'
        );

        $helper->setupSearchRecordsWithPaginator(
            $helper->recoverWrapperRecordsPaginator(
                new PostsGetterWrapper(new PostsGetter($em)),
                array(
                    'moduleCode'    => 'blogs',
                    'orderBy'       => 'p.id DESC',
                    'freeSearch'    => $post['searchtext'],
                ),
                $page,
                $perPage
            ),
            'blogs'
        );

        $helper->setupSearchRecordsWithPaginator(
            $helper->recoverWrapperRecordsPaginator(
                new PostsGetterWrapper(new PostsGetter($em)),
                array(
                    'moduleCode'    => 'photo',
                    'orderBy'       => 'p.id DESC',
                    'freeSearch'    => $post['searchtext'],
                ),
                $page,
                $perPage
            ),
            'photo'
        );

        return $helper;
    }
}