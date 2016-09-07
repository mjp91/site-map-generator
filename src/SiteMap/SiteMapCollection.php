<?php

namespace SiteMap;

/**
 * Constructs a valid XML site map from an array of SiteMapItems
 *
 * Class SiteMapCollection
 * @package SiteMap
 * @author Matthew Pearsall <mjp91@live.co.uk>
 */
class SiteMapCollection
{
    private $siteMapItems;

    /**
     * SiteMapCollection constructor.
     * @param SiteMapItem[] $siteMapItems
     */
    public function __construct(array $siteMapItems)
    {
        $this->siteMapItems = $siteMapItems;
    }

    public function toXml()
    {
        $urlSet = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset></urlset>");
        $urlSet->addAttribute('xmlns', "http://www.sitemaps.org/schemas/sitemap/0.9");
        foreach ($this->siteMapItems as $item) {
            $url = $urlSet->addChild("url");
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

        return $urlSet->asXML();
    }
}