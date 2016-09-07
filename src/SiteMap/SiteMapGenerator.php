<?php namespace SiteMap;

interface SiteMapGenerator
{
    /**
     * Add an item to be included in the generated site map
     *
     * @param SiteMapItem $siteMapItem
     */
    public function addItem(SiteMapItem $siteMapItem);

    /**
     * Generate the site map
     */
    public function generate();
}