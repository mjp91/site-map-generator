<?php namespace SiteMap;

/**
 * Organises items in a site map into chunked files, generates an index referencing these chunked files
 *
 * Class SiteMapXMLWriter
 * @package SiteMap
 * @author Matthew Pearsall <mjp91@live.co.uk>
 */
class SiteMapXMLWriter
{
    private $outputDir;
    private $urlPrefix;
    private $itemLimit;

    private $currentItemCount;
    private $siteMapCount;
    private $siteMapGenerator;
    private $siteMapIndexGenerator;
    private $siteMapFileName;

    /**
     * SiteMapXMLWriter constructor.
     * @param string $outputDir - the directory the site map files should be generated in
     * @param string $urlPrefix - the prefix to prepend to site map item URLs
     * @param int $itemLimit - the amount of items per site map file
     * @param string $siteMapFileName - filename to write files, no extension
     * @throws \Exception
     */
    public function __construct($outputDir, $urlPrefix, $itemLimit = 10000, $siteMapFileName = "sitemap")
    {
        if (!is_dir($outputDir) || !is_writable($outputDir)) {
            throw new \Exception("{$outputDir} is not a directory/writable");
        }

        $this->outputDir = $outputDir;
        $this->urlPrefix = $urlPrefix;
        $this->itemLimit = $itemLimit;

        $this->currentItemCount = 0;
        $this->siteMapCount = 0;
        $this->siteMapGenerator = new SiteMapXMLGenerator();
        $this->siteMapIndexGenerator = new SiteMapIndexXMLGenerator();
        $this->siteMapFileName = $siteMapFileName;
    }

    /**
     * Registers a site map item
     *
     * @param SiteMapItem $siteMapItem
     */
    public function addItem(SiteMapItem $siteMapItem)
    {
        $this->siteMapGenerator->addItem($siteMapItem);
        $this->currentItemCount++;

        if ($this->currentItemCount == $this->itemLimit) {
            $this->writeCurrentSiteMap();
        }
    }

    /**
     * Writes the site map index to a file
     *
     * @throws \Exception
     */
    public function writeSiteMapIndex()
    {
        if ($this->currentItemCount > 0) {
            $this->writeCurrentSiteMap();
        }

        if ($this->siteMapCount == 0) {
            throw new \Exception("No site maps to index");
        }

        $fileName = $this->siteMapFileName . ".xml";
        $fh = @fopen($this->outputDir . '/' . $fileName, 'w');

        if (!$fh) {
            throw new \Exception("Unable to get handle on file {$fileName}");
        }

        fwrite($fh, $this->siteMapIndexGenerator->generate());
        fclose($fh);
    }

    /**
     * Writes the current site map to a file and registers it with the indexer
     *
     * @throws \Exception
     */
    private function writeCurrentSiteMap()
    {
        if ($this->currentItemCount == 0) {
            throw new \Exception("Current site map is empty");
        }

        // create and write to site map
        $fileName = $this->siteMapFileName . ($this->siteMapCount + 1) . ".xml";
        $fh = @fopen($this->outputDir . '/' . $fileName, 'w');

        if (!$fh) {
            throw new \Exception("Unable to get handle on file {$fileName}");
        }

        fwrite($fh, $this->siteMapGenerator->generate());
        fclose($fh);

        // construct a new instance as we're done with the previous site map
        $this->siteMapGenerator = new SiteMapXMLGenerator();

        // register site map with index
        $siteMapURL = $this->urlPrefix . '/' . $fileName;
        $now = new \DateTime();
        $this->siteMapIndexGenerator->addItem(new SiteMapIndexItem($siteMapURL, $now->format('c')));

        // increment site map count
        $this->siteMapCount++;
        // reset the count
        $this->currentItemCount = 0;
    }
}