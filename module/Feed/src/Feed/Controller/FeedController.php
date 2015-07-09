<?php

namespace Feed\Controller;

use Application\Controller\SetupAbstractController;
use Zend\Feed\Writer\Feed;
use Zend\View\Model\FeedModel;
use Zend\View\Model\ViewModel;

/**
 * @author Andrea Fiori
 * @since  20 May 2013
 */
class FeedController extends SetupAbstractController
{
    public function indexAction()
    {
        $moduleConfig = $this->getServiceLocator()->get('config');

        $feedClassMap = $moduleConfig['feed_class_map'];

        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');

        $input = array_merge($configurations, $appServiceLoader->getProperties());

        $resourceClassName = ( isset($feedClassMap[$this->params()->fromRoute('resource')]) ) ?
                                    $feedClassMap[$this->params()->fromRoute('resource')] : null;

        if ( empty($resourceClassName) or !class_exists($resourceClassName) ) {
            return $this->redirect()->toRoute('home', array('lang' => 'it'));
        }

        /**
         * @var \Feed\Model\FeedBuilderAbstract $resourceClassInstance
         */
        $resourceClassInstance = new $resourceClassName();
        $resourceClassInstance->setInput($input);

        $feed = new Feed();
        $feed->setTitle( $resourceClassInstance->getTitle() );
        $feed->setFeedLink($resourceClassInstance->getFeedLink(), $resourceClassInstance->getFeedType());
        // $feed->addAuthor($resourceClassInstance->getAuthor());
        $feed->setDescription($resourceClassInstance->getDescription());
        $feed->setLink($resourceClassInstance->getLink());
        $feed->setDateModified(time());

        $data = $resourceClassInstance->formatRecords(
            $resourceClassInstance->recoverRecords()
        );

        foreach($data as $row)
        {
            $entry = $feed->createEntry();
            $entry->setTitle($row['title']);
            $entry->setLink($row['link']);
            $entry->setDescription($row['content']);

            $entry->setDateModified(strtotime($row['date_created']));
            $entry->setDateCreated(strtotime($row['date_modified']));

            $feed->addEntry($entry);
        }

        $feed->export('rss');

        $feedmodel = new FeedModel();
        $feedmodel->setFeed($feed);

        return $feedmodel;
    }
}
