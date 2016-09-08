<?php

use PHPUnit\Framework\TestCase;
use SiteMap\SiteMapItem;
use SiteMap\SiteMapXMLWriter;

class SiteMapXMLWriteTest extends TestCase
{
    const OUTPUT_DIR = '/tmp/sitemap';
    const ITEM_LIMIT = 10000;

    /**
     * @var SiteMapXMLWriter $siteMapWriter
     */
    private $siteMapWriter;


    public function setUp()
    {
        parent::setUp();
        $this->siteMapWriter = new SiteMapXMLWriter(self::OUTPUT_DIR, 'http://example.com', self::ITEM_LIMIT);
    }

    public function tearDown()
    {
        parent::tearDown();
        $fileToDelete = glob(self::OUTPUT_DIR . '/sitemap*');
        foreach ($fileToDelete as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    public function testFileCreation()
    {
        $items = 50000;
        $expectedSiteMaps = ceil($items / self::ITEM_LIMIT);

        for ($i = 0; $i < 50000; $i++) {
            $this->siteMapWriter->addItem(new SiteMapItem('http://example.com', '2016-09-07', '1.0', 'weekly'));
        }

        $this->siteMapWriter->writeSiteMapIndex();

        for ($i = 1; $i <= $expectedSiteMaps; $i++) {
            $this->assertFileExists(self::OUTPUT_DIR . "/sitemap{$i}.xml");
        }

        $this->assertFileExists(self::OUTPUT_DIR . '/sitemap.xml');
    }
}