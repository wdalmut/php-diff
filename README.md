# Wally Diff [![Build Status](https://secure.travis-ci.org/wdalmut/php-diff.png)](http://travis-ci.org/wdalmut/php-diff?branch=master)

```php
<?php
require_once __DIR__ .'/../src/Wally/Diff.php';

use Wally\Diff;

$m = new Diff();

echo $m->getDiff('Hi, my name is Walter','Hi, my name is Laura');
```

The output is:

```
- Hi, my name is Walter
+ Hi, my name is Laura
```

## Complex input

See a more complex example:

```php
<?php
echo $m->getDiff(<<<EOF
Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. 
Mauris ullamcorper nisi at enim adipiscing vehicula. 
Pellentesque accumsan rutrum porta. 
Sed interdum tortor urna, et condimentum orci. 
Vivamus condimentum ultricies justo vitae lobortis. 
Suspendisse blandit consectetur pulvinar. 
Ut vitae mauris quis enim convallis elementum. 
Vestibulum id dictum nisl.
EOF
,<<<EOF
Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. 
Mauris ullamcorper nisi at enim adipiscing vehicula. 
Pellentesque accumsan rutrum porta. 
Sed interdum cake urna, et condimentum orci. 
Vivamus condimentum ultricies justo vitae lobortis. 
Suspendisse blandit consectetur plumbe. 
Ut vitae mauris quis enim convallis elementum. 
Vestibulum id dictatum nisl.
EOF
);
```

The output is:

```
  Lorem ipsum dolor sit amet, 
  consectetur adipiscing elit. 
  Mauris ullamcorper nisi at enim adipiscing vehicula. 
  Pellentesque accumsan rutrum porta. 
- Sed interdum tortor urna, et condimentum orci. 
+ Sed interdum cake urna, et condimentum orci. 
  Vivamus condimentum ultricies justo vitae lobortis. 
- Suspendisse blandit consectetur pulvinar. 
+ Suspendisse blandit consectetur plumbe. 
  Ut vitae mauris quis enim convallis elementum. 
- Vestibulum id dictum nisl.
+ Vestibulum id dictatum nisl.
```
