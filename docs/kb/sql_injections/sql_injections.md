# Prevent SQL injections

Sensitive SQL calls can turn into sql injection, that’s why it’s very important to know all risks and matters to prevent sql injections. This note is important if you use legacy classes of PrestaShop.

Don’t forget at any time that the validation of any request parameter (GET, POST, body content, sub json variable,…) is very required.


1. [Basic sample](#basic-sample)
2. [Array values sample](#array-values-sample)
3. [Table name or field name protection](#table-name-or-field-name-protection)
4. [OrderBy and orderWay protection](#orderby-and-orderway-protection)
5. [Other cases like case/then, functions…](#other-cases-like-case/then,-functions…)


# Basic sample

@@include[basic_sample.md](includes/basic_sample.md)

# Array values sample
# Table name or field name protection
# OrderBy and orderWay protection
# Other cases like case/then, functions…