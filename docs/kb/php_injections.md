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
