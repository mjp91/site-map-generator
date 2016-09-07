<?php namespace SiteMap;

/**
 * Generates a valid site map index in XML format
 *
 * Class SiteMapXMLGenerator
 * @package SiteMap
 * @author Matthew Pearsall <mjp91@live.co.uk>
 */
class SiteMapXMLGenerator implements SiteMapGenerator
{
    private $urlSet;

    public function __construct()
    {
        $this->urlSet = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset></urlset>");
        $this->urlSet->addAttribute('xmlns', "http://www.sitemaps.org/schemas/sitemap/0.9");
    }

    public function addItem(SiteMapItem $item)
    {
        $url = $this->urlSet->addChild("url");
        $url->addChild("loc", $item->getLocation());

        if ($item->getLastModified()) {
            $url->addChild("lastmod", $item->getLastModified());
        }

        if ($item->getChangeFrequency()) {
            $url->addChild("changefreq", $item->getChangeFrequency());
        }

        if ($item->getPriority()) {
            $url->addChild("priority", $item->getPriority());
        }
    }

    public function generate()
    {
        return $this->urlSet->asXML();
    }
}