# buchin/badwords
PHP bad words detector 

## Installation
```bash
composer require buchin/badwords dev-master
```

## Usage
```php
<?php
use Buchin\Badwords\Badwords;

Badwords::isDirty('Blood sugar sex magic');

/*
when string contains bad words, it returns true
Example result:
(boolean) true 
*/

Badwords::strip('Blood sugar sex magic');

/*
given string contains bad words, it replaces vocal chars in bad word with asterix
Example result:
(string) "Blood sugar s*x magic" 
*/

```