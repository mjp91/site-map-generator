<?php namespace SiteMap;

/**
 * Generates a valid site map index in XML format
 *
 * Class SiteMapIndexXMLGenerator
 * @package SiteMap
 * @author Matthew Pearsall <mjp91@live.co.uk>
 */
class SiteMapIndexXMLGenerator implements SiteMapIndexGenerator
{
    private $siteMapIndex;

    public function __construct()
    {
        $this->siteMapIndex = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><sitemapindex></sitemapindex>");
        $this->siteMapIndex->addAttribute('xmlns', "http://www.sitemaps.org/schemas/sitemap/0.9");
    }

    public function addItem(SiteMapIndexItem $item)
    {
        $siteMap = $this->siteMapIndex->addChild("sitemap");
        $siteMap->addChild("loc", $item->getLocation());
        $siteMap->addChild("lastmod", $item->getLastModified());
    }

    public function generate()
    {
        return $this->siteMapIndex->asXML();
    }
}