<?php

namespace Feed\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Feed\Writer\Feed;
use Zend\View\Model\FeedModel;

/**
 * @author Andrea Fiori
 * @since  20 May 2013
 */
class FeedController extends AbstractActionController
{
    public function indexAction()
    {
        $feed = new Feed();
        $feed->setTitle('Feed Example');
        $feed->setFeedLink('http://ourdomain.com/rss', 'atom');
        $feed->addAuthor(array(
            'name'  => 'admin',
            'email' => 'contact@ourdomain.com',
            'uri'   => 'http://www.ourdomain.com',
             ));
        $feed->setDescription('Description of this feed');
        $feed->setLink('http://ourdomain.com');
        $feed->setDateModified(time());
 
        $data = array(
            0 => array('title' => 'my 1st post', 'link' => 'http://ourdomain.com/1stpost',
                       'content'=> 'summary of 1st post',
                       'date_created' => '2012-01-01 00:00:00',
                       'date_created' => '2012-01-01 00:00:00'
                       ),
            1 => array('title' => 'my 2nd post', 'link' => 'http://ourdomain.com/2ndpost',
                       'content'=> 'summary of 2nd post',
                       'date_created' => '2012-02-01 00:00:00',
                       'date_created' => '2012-02-01 00:00:00'),
            2 => array('title' => 'my 3rd post', 'link' => 'http://ourdomain.com/3rdpost',
                       'content'=>'summary of 3rd post',
                       'date_created' => '2012-03-01 00:00:00',
                       'date_created' => '2012-03-01 00:00:00'),
        );
 
        foreach($data as $row)
        {
            $entry = $feed->createEntry();
            $entry->setTitle($row['title']);
            $entry->setLink($row['link']);
            $entry->setDescription($row['content']);
 
            $entry->setDateModified(strtotime($row['date_created']));
            $entry->setDateCreated(strtotime($row['date_created']));
 
            $feed->addEntry($entry);
        }

        $feed->export('rss');
 
        $feedmodel = new FeedModel();
        $feedmodel->setFeed($feed);

        return $feedmodel;
    }
}
