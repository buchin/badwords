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

Badwords::negationCheck("You are not an asshole");
/*
When string contains a negator like not, aren't, etc before the offensive word
it returns 0
Output:
-1 means NOT FOUND
0 means found with a negator before the offensive word (Neutral)
1 means offensive word was found

Note: The negator can appear before an article just like the example above, or directly before the bad word
E.g of articles: "a", "an", "the"
*/

Badwords::strip('Blood sugar sex magic');

/*
given string contains bad words, it replaces vocal chars in bad word with asterix
Example result:
(string) "Blood sugar s*x magic" 
*/

```
