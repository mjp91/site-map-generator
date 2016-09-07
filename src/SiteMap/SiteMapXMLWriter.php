<?php namespace SiteMap;


class SiteMapXMLWriter
{
    private $outputDir;
    private $urlPrefix;
    private $itemLimit;

    private $currentItemCount;
    private $siteMapCount;
    private $siteMapGenerator;
    private $siteMapIndexGenerator;

    /**
     * SiteMapWriter constructor.
     * @param string $outputDir
     * @param $urlPrefix
     * @param int $itemLimit
     * @throws \Exception
     */
    public function __construct($outputDir, $urlPrefix, $itemLimit = 10000)
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
    }

    public function addItem(SiteMapItem $siteMapItem)
    {
        if ($this->currentItemCount == $this->itemLimit) {
            $this->writeCurrentSiteMap();
        }

        $this->siteMapGenerator->addItem($siteMapItem);
        $this->currentItemCount++;
    }

    public function finish()
    {
        if ($this->currentItemCount > 0) {
            $this->writeCurrentSiteMap();
        }

        if ($this->siteMapCount > 0) {
            $this->writeSiteMapIndex();
        }
    }

    private function writeCurrentSiteMap()
    {
        if ($this->currentItemCount == 0) {
            throw new \Exception("Current site map is empty");
        }

        // create and write to site map
        $fileName = "sitemap" . ($this->siteMapCount + 1) . ".xml";
        $fh = @fopen($this->outputDir . '/' . $fileName, 'w');

        try {
            if (!$fh) {
                throw new \Exception("Unable to get handle on file {$fileName}");
            }
            fwrite($fh, $this->siteMapGenerator->generate());
        } finally {
            fclose($fh);
        }

        // add file name to list of created site maps
        $siteMapURL = $this->urlPrefix . '/' . $fileName;
        $now = new \DateTime();
        $this->siteMapIndexGenerator->addItem(new SiteMapIndexItem($siteMapURL, $now->format('c')));

        // increment site map count
        $this->siteMapCount++;
        // reset the count
        $this->currentItemCount = 0;
    }

    private function writeSiteMapIndex()
    {
        if ($this->siteMapCount == 0) {
            throw new \Exception("No site maps to index");
        }

        $fileName = "sitemap.xml";
        $fh = @fopen($this->outputDir . '/' . $fileName, 'w');

        try {
            if (!$fh) {
                throw new \Exception("Unable to get handle on file {$fileName}");
            }

            fwrite($fh, $this->siteMapIndexGenerator->generate());
        } finally {
            fclose($fh);
        }
    }
}