# Prevent sensitive data disclosure

1. [Logs, data export, …](#logs-data-export)
2. [White reader, white deleter, …](#white-reader-white-deleter)
3. [Deny any none useful file extensions](#deny-any-none-useful-file-extensions)

## Logs, data export, …

Debug files or exports generated inside a module can contain sensitive technical or personal data.

It’s recommended to store logs in var/logs native PrestaShop directory of or choose a shuffled none predictable file name, for instance :

> ***DO:***
> ```PHP
> file_put_contents(__DIR__ . '/csv/order-' . md5(time() . rand()) . '.csv', $content);
> ```

## White reader, white deleter, …

It can be a good idea to create a controller to read a sensitive file and check for instance that the customer is authenticated.

> ***DON'T DO:***
> ```PHP
> echo file_get_contents(__DIR__ . '/csv/' . Tools::getValue($file));
> ```

If `$file = ../../app/config/parameter.php` your controller will return sensitive configuration data.

To prevent any call outside csv directory use basename method: 

> ***DO:***
> ```PHP
> echo file_get_contents(__DIR__ . '/csv/' . basename(Tools::getValue($file)));
> ```

Moreover, it’s recommended to check the type of files and mime type.


## Deny any none useful file extensions

The easiest way to deny none useful is to add in the root directory of your module this htaccess file.

> **Apache 2.2**
> <IfModule !mod_authz_core.c>
>    Order deny,allow
>    Deny from all
>    <Files ~ "(?i)^.*\.(jpg|jpeg|gif|png|bmp|tiff|svg|pdf|mov|mpeg|mp4|avi|mpg|wma|flv|webm|ico|webp|woff|woff2|ttf|eot|html|css|js)$">
>        Allow from all
>    </Files>
> </IfModule>
> ```

> **Apache 2.4**
> <IfModule mod_authz_core.c>
>    Require all denied
>    <Files ~ "(?i)^.*\.(jpg|jpeg|gif|png|bmp|tiff|svg|pdf|mov|mpeg|mp4|avi|mpg|wma|flv|webm|ico|webp|woff|woff2|ttf|eot|html|css|js)$">
>        Require all granted
>    </Files>
> </IfModule>
> ```

Do not forget htaccess is available on Apache but not on nginx.

Note : This htaccess deny php direct call too. It also prevents [standalone scripts without ModuleFrontController](https://docs.google.com/document/d/1CvbzwhN-C1MNfmXykfIG6HBogh_EI4dvdgrmW3m4hh8/edit#heading=h.u5uy9tq7sq3g).