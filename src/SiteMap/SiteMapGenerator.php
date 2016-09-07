<?php namespace SiteMap;


interface SiteMapGenerator
{
    public function addItem(SiteMapItem $siteMapItem);

    public function generate();
}