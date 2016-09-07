<?php namespace SiteMap;

interface SiteMapIndexGenerator
{
    /**
     * Add an item to be included in the generated site map index
     *
     * @param SiteMapIndexItem $siteMapIndexItem
     */
    public function addItem(SiteMapIndexItem $siteMapIndexItem);

    /**
     * Generate the site map index
     */
    public function generate();
}