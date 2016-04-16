# XML Site Map Generator

Classes to model and generate an XML site map for use by web crawlers.

## Composer
```json
"require": {
    "mjp91/sitemap-generator ": "1.0.*"
}
```

## Example

### Usage

```php
$items = [
    new SiteMapItem("http://example.com"),
    new SiteMapItem("http://example.com/foo", "2016-04-16", "monthly", 0.8),
    new SiteMapItem("http://example.com/bar", null, "always", 0.6)
];

$collection = new SiteMapCollection($items);

echo $collection->toXml();
```

### Output

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