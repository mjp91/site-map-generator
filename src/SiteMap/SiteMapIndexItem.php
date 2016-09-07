<?php namespace SiteMap;

/**
 * Models a site map index
 *
 * Class SiteMapIndexItem
 * @package SiteMap
 * @author Matthew Pearsall <mjp91@live.co.uk>
 */
class SiteMapIndexItem
{
    private $location;
    private $lastModified;

    public function __construct($location, $lastModified)
    {
        $this->location = $location;
        $this->lastModified = $lastModified;
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
     * @return mixed
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param mixed $lastModified
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }
}