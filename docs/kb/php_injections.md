---
layout: default
title: 202 ecommerce Security Advisories
is_kb_page: true
to_home_page: true
---

# Prevent PHP injections

## Basic sample

> ***DON'T DO:***
> ```PHP
> $id = Tools::getValue('id_adress');
> $file = Tools::getValue('file', 'address-'.$id.'.json');
> $address = (new Address($id))->toArray();
> $content = json_encode($address);
>
> echo file_put_contents(__MODULE_DIR__ . '/json/' . $file, $content);
> ```

This is a critical vulnerability.

In fact, if the content of an address street is `Yellow <?php echo ‘123’; ?> Stone` and `$_GET[file] = test.php`, the request will push a php file test.php containing a php file.

<br>

****

<br>

[![go left](/images/left-arrow-9133251.png)](/security-advisories/kb/sql_injections.html) | [Prevent SQL injections](/sql_injections.md) | [![go back](/images/back-to-menu-arrow-9121722.png)](/security-advisories/kb/index.html) | [![go up](/images/up-arrow-1767592-1502496.png)](#prevent-php-injections) | [Prevent sensitive data disclosure](/sensitive_data_disclosure.md) | [![go right](/images/right-arrow.png)](/security-advisories/kb/sensitive_data_disclosure.html)

