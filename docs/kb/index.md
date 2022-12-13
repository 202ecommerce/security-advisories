# PrestaShop Modules Security: Knowledge base

1. [Prevent SQL injections](/pages/sql_injections.md)
    1. [Basic sample](/pages/sql_injections.md#basic-sample)
    2. [Array values sample](/pages/sql_injections.md#array-values-sample)
    3. [Table name or field name protection](/pages/sql_injections.md#table-name-or-field-name-protection)
    4. [OrderBy and orderWay protection](/pages/sql_injections.md#orderby-and-orderway-protection)
    5. [Other cases like case/then or functions](/pages/sql_injections.md#other-cases-like-casethen-or-functions)

2. **[Prevent PHP injections](/pages/php_injections.md)**
    1. [Basic sample](/pages/php_injections.md#basic-sample)

3. **[Prevent sensitive data disclosure](/sql_injections.md)**
    1. [Logs, data export, …]()
    2. [White reader, white deleter, …]()
    3. [Deny any none-useful file extensions]()

4. **[Prevent Cross Script (XSS) vulnerability](/sql_injections.md)**
    1. [Escape assigned variable on templates]()
    2. [None secure svg files]()

5. **[Prevent logical weakness](/sql_injections.md)**
    1. [Standalone script without ModuleFrontController]()
    2. [Weakness token in a front controller]()
    3. [Callback of a wildcard method]()
    4. [Wildcard data in the PrestaShop secures cookie]()

6. **[Prevent chain of vulnerability](/sql_injections.md)**
    1. [None obvious trusted data]()
    2. [Sample with file_put_contents]()
