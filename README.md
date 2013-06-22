PhantomJS Module
================

## Example

```php
$phantomjs = $serviceLocator->get('phantomjs');
$result = $phantom->executeScript('HttpGet.js', 'http://www.google.com');
```
