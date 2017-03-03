# XML Site Map Generator
Classes to model and generate XML site maps for use by web crawlers. Supports
the creation of multiple site maps with a configurable number of URLs per 
site map and the generation of a site map index. Each URL can be configured with language annotations for pages with multiple languages.


## Composer
```json
{
    "require": {
        "mjp91/sitemap-generator": "1.2.*"
    }
}
```

## Example
###Singular
#### Usage
```php
$items = array(
    new SiteMapItem("http://example.com"),
    new SiteMapItem("http://example.com/foo", "2016-04-16", "monthly", 0.8),
    new SiteMapItem("http://example.com/bar", null, "always", 0.6)
);

$collection = new SiteMapCollection($items);

echo $collection->toXml();
```

#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://example.com</loc>
    </url>
    <url>
        <loc>http://example.com/foo</loc>
        <lastmod>2016-04-16</lastmod>
        <changefreq>0.8</changefreq>
        <priority>monthly</priority>
    </url>
    <url>
        <loc>http://example.com/bar</loc>
        <changefreq>0.6</changefreq>
        <priority>always</priority>
    </url>
</urlset>
```

###Multiple
#### Usage
```php
// configure output directory, URL prefix and URLs per site map
$siteMapWriter = new SiteMapXMLWriter('/var/www/example.com', "http://example.com", 50000);

// add records to writer
$siteMapWriter->addItem(new SiteMapItem("http://example.com"));
$siteMapWriter->addItem(new SiteMapItem("http://example.com/foo", "2016-04-16", "monthly", 0.8));
$siteMapWriter->addItem(new SiteMapItem("http://example.com/bar", null, "always", 0.6));
$siteMapWriter->addItem($item);

// finish generation and write index file
$siteMapWriter->writeSiteMapIndex();
```

#### Output
#####`/var/www/example.com/sitemap.xml`
```xml
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>http://example.com/sitemap1.xml</loc>
        <lastmod>2016-09-20T14:33:32+01:00</lastmod>
    </sitemap>
</sitemapindex>
```

#####`/var/www/example.com/sitemap1.xml`
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://example.com</loc>
    </url>
    <url>
        <loc>http://example.com/foo</loc>
        <lastmod>2016-04-16</lastmod>
        <changefreq>0.8</changefreq>
        <priority>monthly</priority>
    </url>
    <url>
        <loc>http://example.com/bar</loc>
        <changefreq>0.6</changefreq>
        <priority>always</priority>
    </url>
</urlset>
```

###Using language annotations
#### Usage
```php
// configure output directory, URL prefix and URLs per site map
$siteMapWriter = new SiteMapXMLWriter('/var/www/example.com', "http://example.com", 50000);

// add records to writer
$siteMapWriter->addItem(new SiteMapItem("http://example.com"));

// optional: add alternate links for specific language pages
$item = new SiteMapItem("http://example.com/foo-bar");
$item->addRelAlternate(array(
                               "hreflang" => "en",
                               "href" => "http://example.com/foo-bar"
                           )
                       );
$item->addRelAlternate(array(
                               "hreflang" => "de",
                               "href" => "http://example.com/de/foo-bar"
                           )
                       );
$siteMapWriter->addItem($item);

// finish generation and write index file
$siteMapWriter->writeSiteMapIndex();
```

#### Output
#####`/var/www/example.com/sitemap.xml`
```xml
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>http://example.com/sitemap1.xml</loc>
        <lastmod>2016-09-20T14:33:32+01:00</lastmod>
    </sitemap>
</sitemapindex>
```

#####`/var/www/example.com/sitemap1.xml`
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://example.com</loc>
    </url>
    <url>
        <loc>http://example.com/foo-bar</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        <xhtml:link rel="alternate" hreflang="en"
                    href="http://example.com/foo-bar"/>
        <xhtml:link rel="alternate" hreflang="de"
                    href="http://example.com/de/foo-bar"/>
    </url>
</urlset>
```