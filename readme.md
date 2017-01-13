# XML Site Map Generator
Classes to model and generate XML site maps for use by web crawlers. Supports
the creation of multiple site maps with a configurable number of URLs per 
site map and the generation of a site map index.

## Composer
```json
"require": {
    "mjp91/sitemap-generator": "1.1.*"
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