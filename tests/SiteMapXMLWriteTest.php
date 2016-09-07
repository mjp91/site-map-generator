<?php

use PHPUnit\Framework\TestCase;
use SiteMap\SiteMapItem;
use SiteMap\SiteMapXMLWriter;

class SiteMapXMLWriteTest extends TestCase
{
    private $outputDir;

    /**
     * @var SiteMapXMLWriter $siteMapWriter
     */
    private $siteMapWriter;

    public function setUp()
    {
        parent::setUp();
        $this->outputDir = '/tmp/sitemap';
        $this->siteMapWriter = new SiteMapXMLWriter($this->outputDir, 'http://example.com', 10000);
    }

    public function tearDown()
    {
        parent::tearDown();
        $fileToDelete = glob($this->outputDir . '/sitemap*');
        foreach ($fileToDelete as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    public function testFileCreation()
    {
        for ($i = 0; $i < 50000; $i++) {
            $this->siteMapWriter->addItem(new SiteMapItem('http://example.com', '2016-09-07', '1.0', 'weekly'));
        }

        $this->siteMapWriter->finish();

        $this->assertTrue(@file_exists($this->outputDir . '/sitemap.xml'));
    }
}