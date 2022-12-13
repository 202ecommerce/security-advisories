# Prevent SQL injections

Sensitive SQL calls can turn into sql injection, that’s why it’s very important to know all risks and matters to prevent sql injections. This note is important if you use legacy classes of PrestaShop.

Don’t forget at any time that the validation of any request parameter (GET, POST, body content, sub json variable,…) is very required.

1. [Basic sample](#basic-sample)
2. [Array values sample](#array-values-sample)
3. [Table name or field name protection](#table-name-or-field-name-protection)
4. [OrderBy and orderWay protection](#orderby-and-orderway-protection)
5. [Other cases like case/then, functions, etc](#other-cases-like-case/then,-functions,-etc)

## Basic sample

> ***DON'T DO :***
>``
>function test(int $id, string $name) {
>    $querystr = 'SELECT id, name FROM mytable WHERE id = $id AND name = "' . $name . '"';
>    return Db::getInstance()->executeS($querystr);
>}
>``

This request has a vulnerability named “sensitive sql call” because if :

> `$name = 'dummy" UNION SELECT id_configuration AS id, value AS name FROM ps_configuration;#';`

The previous method test() will return the list of PrestaShop configuration tables with this sql injection.

To fix this sensitive SQL call you need to use pSQL(`$name`) like this. In this case, characters " will be backslash.

Please note: **pSQL is not efficient without quotes**, for integer variables. Some malicious injections can be forged without quote like :

> `$id = '1; DROP TABLE test;#'`  
> `(pSQL($id) == $id) === true`

The same method (variant using also *DbQuery* class) without the type hint of test method argument. Do not use pSQL to fix this sensitive SQL call, use an explicit casting like (int) (or float if need) :

> ***DO :***
>
> `function test($id, $name) {`  
>    `$query = new DbQuery();`  
>    `$query->select('id, name');`  
>    `$query->from('mytable');`  
>    `$query->where('id = ' . (int) $id . ' AND name = "' . pSQL($name) . '"');`  
>    `$results = Db::getInstance()->executeS($query);`  
> `}`

Other recommandations :
 - The cast (string), (array) or (object) don't protect anything. Be careful with data from a JSON string that can have a sub argument not secured !
 - **Do not “hide” your parameters in base64. WAF (Applicative firewall) are not efficient to detect SQL injections if it’s un base64 !**

For quick reviewing or if you want to automate some regex to improve quality and security checks, it’s highly recommended to add your protection method as near as possible of the SQL call ! As far, not in a different file. No impact on performance in case of several (int) or pSQL().


## Array values sample

## Table name or field name protection

## OrderBy and orderWay protection

## Other cases like case/then, functions, etc