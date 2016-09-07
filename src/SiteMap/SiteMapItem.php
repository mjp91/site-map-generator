<?php

namespace SiteMap;

/**
 * Models an individual item in a site map
 *
 * Class SiteMapItem
 * @package SiteMap
 * @author Matthew Pearsall <mjp91@live.co.uk>
 */
class SiteMapItem
{
    private $location;
    private $lastModified;
    private $changeFrequency;
    private $priority;

    /**
     * SiteMapItem constructor.
     * @param $location
     * @param $lastModified
     * @param $priority
     * @param $changeFrequency
     */
    public function __construct($location, $lastModified = null, $priority = null, $changeFrequency = null)
    {
        $this->location = $location;
        $this->lastModified = $lastModified;
        $this->priority = $priority;
        $this->changeFrequency = $changeFrequency;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return null
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param null $lastModified
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }

    /**
     * @return null
     */
    public function getChangeFrequency()
    {
        return $this->changeFrequency;
    }

    /**
     * @param null $changeFrequency
     */
    public function setChangeFrequency($changeFrequency)
    {
        $this->changeFrequency = $changeFrequency;
    }

    /**
     * @return null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param null $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}