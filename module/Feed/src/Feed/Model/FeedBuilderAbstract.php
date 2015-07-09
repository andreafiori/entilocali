<?php

namespace Feed\Model;
use ModelModule\Model\InputSetterGetterAbstract;

/**
 * Help to build an RSS output
 *
 * @author Andrea Fiori
 * @since  01 March 2015
 */
abstract class FeedBuilderAbstract extends InputSetterGetterAbstract
{
    protected $title;

    protected $description;

    protected $link;

    protected $feedLink;

    protected $FeedType = 'atom';

    protected $author = array();

    protected $numbersOfEntries = 8;

    /**
     * @return int
     */
    public function getNumbersOfEntries()
    {
        return $this->numbersOfEntries;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getFeedLink()
    {
        return $this->feedLink;
    }

    /**
     * @param string $feedLink
     */
    public function setFeedLink($feedLink)
    {
        $this->feedLink = $feedLink;
    }

    /**
     * @return string
     */
    public function getFeedType()
    {
        return $this->FeedType;
    }

    /**
     * @param string $FeedType
     */
    public function setFeedType($FeedType)
    {
        $this->FeedType = $FeedType;
    }

    /**
     * @return array
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param array $author
     */
    public function setAuthor( array $author)
    {
        $this->author = $author;
    }
}