<?php

namespace Admin\Controller\Photo;

use Admin\Model\Posts\CategoriesGetter;
use Admin\Model\Posts\CategoriesGetterWrapper;
use Admin\Model\Posts\PostsFormSearch;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Application\Controller\SetupAbstractController;

class PhotoSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
        $wrapper->setInput( array(
                'moduleCode' => 'photo',
                'userId'     => null,
                'orderBy'    => 'p.id DESC',
                'fields'     => 'DISTINCT(p.id) AS id, p.lastUpdate,
                                    p.createDate, p.expireDate, p.hasAttachments,
                                    p.title, p.subtitle, p.description, p.slug, p.seoTitle,
                                    p.seoDescription, p.seoKeywords,
                                    users.name AS userName, users.surname AS userSurname'
            )
        );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator($wrapper->setupQuery($em));
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage($perPage);

        $paginator = $wrapper->getPaginator();

        $postsRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Foto',
            'tableDescription'  => $paginator->getTotalItemCount().' posts in archivio',
            'paginator'         => $paginator,
            'records'           => $this->formatColumnRecords($postsRecords),
            'columns' => array(
                'Foto',
                "Titolo",
                "Categorie",
                //"Tags",
                "Inserito da",
                "Ultima modifica",
                "&nbsp;",
                "&nbsp;",
                "&nbsp;"
            ),
            'formSearch'        => '',
            'templatePartial'   => self::summaryTemplate
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param mixed $records
     * @return array
     */
    private function formatColumnRecords($records)
    {
        $recordsToReturn = array();
        foreach($records as $record) {

            $categoryToPrint = '';
            foreach($record['categories'] as $category) {
                $categoryToPrint .= $category['name']."<br>";
            }

            $recordsToReturn[] = array(
                $record['title'],
                $categoryToPrint,
                //'', TAGS ROW...
                $record['userName'].' '.$record['userSurname'],
                "<strong>Inserito il:</strong> ".date("d-m-Y", strtotime($record['createDate'])).
                "<br><br><strong>Ultima modifica:</strong> ".date("d-m-Y", strtotime($record['lastUpdate'])),
                array(
                    'type' => 'updateButton',
                    'href' => $this->url()->fromRoute('admin/posts-form', array(
                        'lang'      => 'it',
                        'formtype'  => 'photo',
                        'id'        => $record['id']
                    )),
                    'title' => 'Modifica'
                ),
                array(
                    'type'      => 'deleteButton',
                    'title'     => 'Elimina',
                    'href'      => '#',
                    'data-id'   => $record['id']
                ),
            );
        }

        return $recordsToReturn;
    }
}