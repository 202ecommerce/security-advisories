# Prevent logical weakness

  - [Standalone script without ModuleFrontController](#standalone-script-without-modulefrontcontroller)
  - [Weakness token in a front controller](#weakness-token-in-a-front-controller)
  - [Callback of a wildcard method](#callback-of-a-wildcard-method)
  - [Wildcard data in the PrestaShop secures cookie](#wildcard-data-in-the-prestashop-secures-cookie)

## Standalone script without ModuleFrontController

Since PrestaShop 1.6, you can create a class that extends ModuleFrontController. Before 1.6, you can found addons with files like this, but [don’t do that](https://devdocs.prestashop-project.org/8/modules/creation/good-practices/) :

> ***DON'T DO***
> ```php
> <?php
> // modules/mymodule/ajax.php
> include(dirname(__FILE__) . '/../../config/config.inc.php');
> include(dirname(__FILE__) . '/../../init.php');
> $mymodule = new mymodule();
> ```

This kind of code calls legacy PrestaShop Dispatcher and bypass all PrestaShop module loading security checks. So this script remains available if the module is disabled or uninstalled !

Recommandations :
 - As a maintainer of a PrestaShop website, remove physically from the server all unused modules.
 - As a developer, 
    - if you cannot have another solution add explicitly a check that disabled this script if the module is disabled.
    - Add a check of PrestaShop < 1.6 and create an equivalent module frontend controller (see this [doc](https://devdocs.prestashop-project.org/8/modules/concepts/controllers/front-controllers/#creating-a-front-controller))

## Weakness token in a front controller

It’s sometimes useful to protect a front controller with a static token for instance to protect a cron, a webhook, …

####  1) *Check if 'PS_TOKEN_ENABLE' is enabled will deactivate the protection. This feature is not done to protect a controller.*

> ***DON'T DO:***
> ```PHP
> if (Configuration::get('PS_TOKEN_ENABLE') == 1 &&
>        (Tools::getValue('token') != ools::encrypt('mymodule'))) {
>    echo 'Invalid token!';
>    die();
> }
> ```

Use instead:

> ***DO:***
> ```PHP
> if (Tools::getValue('token') != Tools::encrypt('mymodule')) {
>    echo 'Invalid token!';
>    die();
> }
> ```

####  2) *Tools::getToken() is assigned as a JavaScript variable on all pages. If you use this method, the token is predictable and not safe.*

> ***DON'T DO:***
> ```PHP
> if (Tools::getValue('token') != Tools::getToken()) {
>    echo 'Invalid token!';
>    die();
> }
> ```

Use instead:

> ***DO:***
> ```PHP
> if (Tools::getValue('token') != Tools::encrypt('mymodule')) {
>    echo 'Invalid token!';
>    die();
> }
> ```

####  3) *Compare the token submitted with a predictable parameter. Add a secret like the COOKIE_KEY as salt !*

> ***DON'T DO:***
> ```PHP
> if (Tools::getValue('token') != sha1($this->module->name.'-'.$this->module->version)) {
>    echo 'Invalid token!';
>    die();
> }
> ```

Use instead:

> ***DO:***
> ```PHP
> if (Tools::getValue('token') != sha1($this->module->name . _COOKIE_KEY_)) {
>    echo 'Invalid token!';
>    die();
> }
> ```

####  4) *If you store a PrestaShop Configuration and compare it to a GET or POST parameter, check previously the configuration and the token submitted value is not empty (isset is not suffisant). In fact, the PrestaShop configuration with the referral token can be empty before module activation (or empty by an sql injection). In this case, the controller is potentially available with an empty token !*

> ***DON'T DO:***
> ```PHP
> if (isset(Tools::getValue('token')) === true ||
>        Tools::getValue('token') != Configuration::get('MYMODULE_TOKEN')) {
>    echo 'Invalid token!';
>    die();
> }
> ```

Use instead:

> ***DO:***
> ```PHP
> if (empty(Tools::getValue('token')) === true ||
>        Tools::getValue('token') != Configuration::get('MYMODULE_TOKEN')) {
>    echo 'Invalid token!';
>    die();
> }
> ```

## Callback of a wildcard method

This is an example that can call any method of the main Module classes like getAdminFullUrl.

> ***DON'T DO:***
> ```PHP
> class MyModule extends Module
> {
>   public function hookDisplayHeader()
>   {
>        if (Tools::getIsset('ajax') && Tools::getIsset('method')) {
>           $ajax = Tools::getValue('method');
>        	if (method_exists($this, $ajax)) {
>                $result = $this->$ajax();
>                die(Tools::jsonEncode($result));
>        	}
>       }
>   }
> }
> ```

To prevent any malicious uses, you need to define an exhaustive list of permitted methods to call.

> ***DO:***
> ```PHP
> class MyModule extends Module
> {
>   public function hookDisplayHeader()
>   {
>        if (Tools::getIsset('ajax') && Tools::getIsset('method')) {
>        	$ajax = Tools::getValue('method');
>        	if (method_exists($this, $ajax) && in_array($ajax, ['ajaxPrice','ajaxLink',])) {
>               $result = $this->$ajax();
>               die(Tools::jsonEncode($result));
>        	}
>       }
>   }
> }
> ```

## Wildcard data in the PrestaShop secures cookie

This code saves in the PrestaShop secured cookie a new variable.

> ***DON'T DO:***
> ```PHP
> class TestModuleFrontController extends ModuleFrontController
> {
>    public function displayAjaxFavoriteOrder() {
>        $name = Tools::getValue('name');
>        $this->context->cookie->$name = Tools::getValue('value');
>        $this->context->cookie->write();
>    }
> }
> ```

But it can also be used to update other data of the cookie like the sessions.

> ***DO:***
> ```PHP
> class TestModuleFrontController extends ModuleFrontController
> {
>    public function displayAjaxFavoriteOrder() {
>        $name = Tools::getValue('name');
>        if (in_array($name, ['product', 'category',]) === false) {
>           exit;
>        }
>        $this->context->cookie->$name = Tools::getValue('value');
>        $this->context->cookie->write();
>    }
> }
> ```

<br>

****

<br>

[![go left](/images/left-arrow-9133251.png)](/security-advisories/kb/cross_script_vulnerability.html) | [Prevent Cross Script (XSS) vulnerability](/cross_script_vulnerability.md) | [![go back](/images/back-to-menu-arrow-9121722.png)](/security-advisories/kb/index.html) | [![go up](/images/up-arrow-1767592-1502496.png)](#prevent-logical-weakness) | [Prevent chain of vulnerability](/chain_of_vulnerability.md) | [![go right](/images/right-arrow.png)](/security-advisories/kb/chain_of_vulnerability.html)