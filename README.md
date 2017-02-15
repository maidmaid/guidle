Guidle
======

[Guidle](http://www.guidle.com) client library. Require >= 5.3.

## Installation

```
composer require maidmaid/guidle
```

## Usage

```php
<?php

use Maidmaid\Guidle\Guidle;

$guidle = new Guidle('http://www.guidle.com/...');

foreach ($guidle->getOffers() as $o) {
    // title
    $d = $guidle->getOfferDetail($o);
    echo $guidle->getOfferDetailTitle($d)."\n";;

    // dates
    foreach ($guidle->getOfferDates($o) as $d) {
        echo $guidle->getOfferStartDate($d)."\n";
        echo $guidle->getOfferEndDate($d)."\n";
        echo implode(' ', $guidle->getOfferWeekdaysDate($d))."\n";
    }

    echo "\n";
}
```

## License

Guidle client library is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.