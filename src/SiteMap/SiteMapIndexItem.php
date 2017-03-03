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
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param string $lastModified
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }
}