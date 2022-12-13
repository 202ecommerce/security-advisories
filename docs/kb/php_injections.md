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

[![go left](/images/resized/left-arrow-9133251.png)](/sql_injections.md)
[Prevent SQL injections](/sql_injections.md)

[![go back](/images/resized/back-to-menu-arrow-9121722.png)](../index.md)

[![go up](/images/resized/up-arrow-1767592-1502496.png)](#prevent-php-injections)

[Prevent sensitive data disclosure](/sensitive_data_disclosure.md)
[![go right](/images/resized/right-arrow.png)](/sensitive_data_disclosure.md)