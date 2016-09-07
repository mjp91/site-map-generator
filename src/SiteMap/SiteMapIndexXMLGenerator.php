<?php namespace SiteMap;


class SiteMapIndexXMLGenerator implements SiteMapIndexGenerator
{
    private $siteMapIndex;

    public function __construct()
    {
        $this->siteMapIndex = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><siteMapIndex></siteMapIndex>");
        $this->siteMapIndex->addAttribute('xmlns', "http://www.sitemaps.org/schemas/sitemap/0.9");
    }

    public function addItem(SiteMapIndexItem $item)
    {
        $this->siteMapIndex->addChild("loc", $item->getLocation());
        $this->siteMapIndex->addChild("lastmod", $item->getLastModified());
    }

    public function generate()
    {
        return $this->siteMapIndex->asXML();
    }
}