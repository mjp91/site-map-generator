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
    private $relAlternates;

    /**
     * SiteMapItem constructor.
     * @param $location
     * @param $lastModified
     * @param $priority
     * @param $changeFrequency
     * @param array $relAlternates
     */
    public function __construct($location, $lastModified = null, $priority = null, $changeFrequency = null, $relAlternates = array())
    {
        $this->location = $location;
        $this->lastModified = $lastModified;
        $this->priority = $priority;
        $this->changeFrequency = $changeFrequency;
        $this->relAlternates = $relAlternates;
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

    /**
     * @return string
     */
    public function getChangeFrequency()
    {
        return $this->changeFrequency;
    }

    /**
     * @param string $changeFrequency
     */
    public function setChangeFrequency($changeFrequency)
    {
        $this->changeFrequency = $changeFrequency;
    }

    /**
     * @return float
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param float $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * Add a rel alternate link for this item
     * e.g. array("hreflang" => "de", "href" => "http://example.com/de/page");
     * ref: https://support.google.com/webmasters/answer/2620865?hl=en&ref_topic=6080646
     * 'hreflang' must be ISO_639-1: https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
     * 'href' must be full url including protocol and domain
     * @param array $alternative
     */
    public function addRelAlternate(array $alternative)
    {
        $this->relAlternates[] = $alternative;
    }

    /**
     * @return array
     */
    public function getRelAlternates()
    {
        return $this->relAlternates;
    }
}