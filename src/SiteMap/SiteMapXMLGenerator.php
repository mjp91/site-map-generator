<?php namespace SiteMap;

/**
 * Generates a valid site map in XML format
 *
 * Class SiteMapXMLGenerator
 * @package SiteMap
 * @author Matthew Pearsall <mjp91@live.co.uk>
 */
class SiteMapXMLGenerator implements SiteMapGenerator
{
    private $urlSet;

    /**
     * SiteMapXMLGenerator constructor.
     */
    public function __construct()
    {
        $this->urlSet = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset></urlset>");
        $this->urlSet->addAttribute('xmlns:xmlns:xhtml', "http://www.w3.org/1999/xhtml");
        $this->urlSet->addAttribute('xmlns', "http://www.sitemaps.org/schemas/sitemap/0.9");
    }

    /**
     * Add url to site map
     * @param SiteMapItem $item
     */
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

        if ($item->getRelAlternates()) {
            foreach ($item->getRelAlternates() as $equivalentKey => $equivalentValue) {
                $link = $url->addChild('xmlns:xhtml:link');
                $link->addAttribute('rel', 'alternate');
                $link->addAttribute('hreflang', $equivalentValue['hreflang']);
                $link->addAttribute('href', $equivalentValue['href']);

            }
        }
    }

    /**
     * Return generated site map as xml
     * @return mixed
     */
    public function generate()
    {
        return $this->urlSet->asXML();
    }
}