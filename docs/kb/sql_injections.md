---
layout: default
title: 202 ecommerce Security Advisories
is_kb_page: true
to_home_page: true
---

# Prevent SQL injections

Sensitive SQL calls can turn into sql injection, that’s why it’s very important to know all risks and matters to prevent sql injections. This note is important if you use legacy classes of PrestaShop.

Don’t forget at any time that the validation of any request parameter (GET, POST, body content, sub json variable,…) is very required.

1. [Basic sample](#basic-sample)
2. [Array values sample](#array-values-sample)
3. [Table name or field name protection](#table-name-or-field-name-protection)
4. [OrderBy and orderWay protection](#orderby-and-orderway-protection)
5. [Other cases like case/then, functions…](#other-cases-like-casethen-functions)
6. [PrestaShop object models natively protected against SQL injection](#prestashop-object-models-natively-protected-against-sql-injection)

## Basic sample

> ***DON'T DO:***
> ```PHP
> function test(int $id, string $name) {
>     $querystr = 'SELECT id, name FROM mytable WHERE id = $id AND name = "' . $name . '"';
>     return Db::getInstance()->executeS($querystr);
> }
> ```

This request has a vulnerability named “sensitive sql call” because if :

> ```PHP
> $name = 'dummy" UNION SELECT id_configuration AS id, value AS name FROM ps_configuration;#';
> ```

The previous method test() will return the list of PrestaShop configuration tables with this sql injection.

To fix this sensitive SQL call you need to use pSQL(`$name`) like this. In this case, characters " will be backslash.

Please note: **pSQL is not efficient without quotes**, for integer variables. Some malicious injections can be forged without quote like :

> ```PHP
> $id = '1; DROP TABLE test;#'
> (pSQL($id) == $id) === true
> ```

The same method (variant using also *DbQuery* class) without the type hint of test method argument. Do not use pSQL to fix this sensitive SQL call, use an explicit casting like (int) (or float if need) :

> ***DO:***
> ```PHP
> function test($id, $name) {
>    $query = new DbQuery();
>    $query->select('id, name');
>    $query->from('mytable');
>    $query->where('id = ' . (int) $id . ' AND name = "' . pSQL($name) . '"');
>    $results = Db::getInstance()->executeS($query);
> }
> ```

Other recommandations :
 - The cast (string), (array) or (object) don't protect anything. Be careful with data from a JSON string that can have a sub argument not secured !
 - **Do not “hide” your parameters in base64. WAF (Applicative firewall) are not efficient to detect SQL injections if it’s un base64 !**

For quick reviewing or if you want to automate some regex to improve quality and security checks, it’s highly recommended to add your protection method as near as possible of the SQL call ! As far, not in a different file. No impact on performance in case of several (int) or pSQL().


## Array values sample

To protect IN where clause with an array of values, use array map to cast or pSQL to protect each element of the array.

> ***DO:***
> ```PHP
> $ids = [1,2,3];
> $name = ['kiwi', 'apple'];
>
> function test(array $ids, array $name) {
>    $querystr = 'SELECT id, name FROM mytable WHERE id IN ( ' . implode(',', array_map('intval', $ids )) . ' AND name IN ("' . implode ('","', array_map('pSQL', $name )) '")';
>    return $querystr;
>}
> ```

## Table name or field name protection

This is another sensitive SQL call :


> ***DON'T DO:***
> ```PHP
> function test($id, $name) {
>    $querystr = 'SELECT id, ' . $name . ' FROM mytable WHERE id = ' . (int) $id;
>    return Db::getInstance()->executeS($querystr);
> }
> ```

Use `'bqSQL($name)'` will escape backtick characters.

> ***DO:***
> ```PHP
> function test($id, $name) {
>    $querystr = 'SELECT id, `' . bqSQL($name) . '` FROM mytable WHERE id = ' . (int) $id;
>    return Db::getInstance()->executeS($querystr);
> }
> ```

You should always use bqSQL() between two backticks to be efficient !

Do **not** use pSQL() instead of bqSQL().


## OrderBy and orderWay protection

Only class *Validate* with method *isOrderWay() isOrderBy()* before using the parameter is a good solution to prevent SQL injection ! All other solution can introduce SQL error in case of 
 
> ***DON'T DO:***
> ```PHP
>function test($orderWay, $orderBy) {
>    $querystr = 'SELECT id, name FROM mytable ORDER BY `' . bqSQL($orderBy) . '` ' . pSQL($orderWay);
>    return Db::getInstance()->executeS($querystr);
> }
> ```

Instead of this previous sensitive SQL call :

> ***DO:***
> ```PHP
> function test($orderWay, $orderBy) {
>    if (Validate::isOrderWay($orderWay) === false){
>        $orderWay = 'DESC';
>    }
>    if (Validate::isOrderBy($orderBy) === false) {
>        $orderBy = 'name';
>    }
>    $querystr = 'SELECT id, name FROM mytable ORDER BY `' . bqSQL($orderBy) . '` ' . $orderWay;
>    return Db::getInstance()->executeS($querystr);
> }
> ```

Do not use pSQL() or bqSQL() in an order direction.


## Other cases like case/then, functions…

I hope you understand it will be impossible to easily protect parameters when it’s not an integer or a string between quotes or backtick. So, for this specific case you need to refactor your code to send and validate all parameters on your own.

## PrestaShop object models natively protected against SQL injection

PrestaShop object models are natively safe because they include definitions of each field and a validation before a save or an update.

> ***DO:***
> ```PHP
> class Reinsurance extends ObjectModel
> {
>    public $id;
>    public $id_shop;
>    public $text;
>
>    public static $definition = [
>   	 'table' => 'reinsurance',
>   	 'primary' => 'id_reinsurance',
>   	 'multilang' => true,
>   	 'fields' => [
>   	     'id_shop' => ['type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true],
>   	     'text' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true],
>   	 ]
>    ];
> }
>
> $reinsurrance = new Reinsurance();
> $reinsurrance->id_shop = Tools::getValue('id_shop');
> $reinsurrance->text = Tools::getValue('text');
> try {
>    $reinsurrance->save();
> } catch (Exception $e) {
>    // exit;
> }
> ```

pSQL and cast are apply according to the definition.

You can also use PrestaShopCollection based on object model definition.

> ***DO:***
> ```PHP
> $collection = new PrestaShopCollection(Reinsurance::class);
> $collection->where('text', '=',Tools::getValue('text'));
> $collection->sqlWhere('id_shop', '=', Tools::getValue('id_shop'));
> $collection->orderBy('id_reinsurance');
> $reinsurances = $collection->getResults();
> ```

<br>

****

<br>

[![go back](/images/back-to-menu-arrow-9121722.png)](/security-advisories/kb/index.html) | [![go up](/images/up-arrow-1767592-1502496.png)](#prevent-sql-injections) | [Prevent PHP injections](/php_injections.md) | [![go right](/images/right-arrow.png)](/security-advisories/kb/php_injections.html)

