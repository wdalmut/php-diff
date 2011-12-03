My Diff
=======

```php
<?php
require_once __DIR__ .'/../src/Wally/Diff.php';

use Wally\Diff;

$m = new Diff();

echo $m->diff('Hi, my name is Walter','Hi, my name is Laura');
```

The output is:

```
- Hi, my name is Walter
+ Hi, my name is Laura
```

