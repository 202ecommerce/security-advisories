# PrestaShop Modules Security: Knowledge base


1. **[Prevent SQL injections](/sql_injections.md)**
    1. [Basic sample](/sql_injections.md#basic-sample)
    2. [Array values sample](/sql_injections.md#array-values-sample)
    3. [Table name or field name protection](/sql_injections.md#table-name-or-field-name-protection)
    4. [OrderBy and orderWay protection](/sql_injections.md#orderby-and-orderway-protection)
    5. [Other cases like case/then, functions…](/sql_injections.md#other-cases-like-casethen-functions)
<br><br>

2. **[Prevent PHP injections](/php_injections.md)**
    1. [Basic sample](/php_injections.md#basic-sample)
<br><br>

3. **[Prevent sensitive data disclosure](/sensitive_data_disclosure.md)**
    1. [Logs, data export, …](/sensitive_data_disclosure.md#logs-data-export-)
    2. [White reader, white deleter, …](/sensitive_data_disclosure.md#white-reader-white-deleter-)
    3. [Deny any none-useful file extensions](/sensitive_data_disclosure.md#deny-any-none-useful-file-extensions)
<br><br>

4. **[Prevent Cross Script (XSS) vulnerability](/cross_script_vulnerability.md)**
    1. [Escape assigned variable on templates](/cross_script_vulnerability.md#escape-assigned-variable-on-templates)
    2. [None secure svg files](/cross_script_vulnerability.md#none-secure-svg-files)
<br><br>

5. **[Prevent logical weakness](/logical_weakness.md)**
    1. [Standalone script without ModuleFrontController](/logical_weakness.md#standalone-script-without-modulefrontcontroller)
    2. [Weakness token in a front controller](/logical_weakness.md#weakness-token-in-a-front-controller)
    3. [Callback of a wildcard method](/logical_weakness.md#callback-of-a-wildcard-method)
    4. [Wildcard data in the PrestaShop secures cookie](/logical_weakness.md#wildcard-data-in-the-prestashop-secures-cookie)
<br><br>

6. **[Prevent chain of vulnerability](/chain_of_vulnerability.md)**
    1. [None obvious trusted data](/chain_of_vulnerability.md#none-obvious-trusted-data)
    2. [Sample with file_put_contents](/chain_of_vulnerability.md#sample-with-file_put_contents)


<table class="center">
    <tr>
        <td><img src="/images/resized/left-arrow-9133251.png"></td>
        <td>test 1 2 test : fichier précédant</td>
    </tr>
    <tr>
        <td><img src="/images/resized/back-to-menu-arrow-9121722.png"></td>
        <td><img src="/images/resized/up-arrow-1767592-1502496.png"></td>
    </tr>
    <tr>
        <td>test 3 4 test : fichier suivant</td>
        <td><img src="/images/resized/right-arrow.png"></td>
    </tr>
</table>

![go left](/images/resized/left-arrow-9133251.png) | test 1 2 test : fichier précédant

![go back](/images/resized/back-to-menu-arrow-9121722.png)
![go up](/images/resized/up-arrow-1767592-1502496.png)

test 3 4 test : fichier suivant | ![go right](/images/resized/right-arrow.png)
