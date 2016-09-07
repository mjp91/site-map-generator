<?php namespace SiteMap;


interface SiteMapIndexGenerator
{
    public function addItem(SiteMapIndexItem $siteMapIndexItem);

    public function generate();
}