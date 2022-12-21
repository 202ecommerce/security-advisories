---
layout: default
title: 202 ecommerce Security Advisories
is_index: true
is_cve_page: true
to_home_page: true
---

{% assign allcve = site.data.cve %}

{% for cve in allcve -%}

    {% if cve.affect.vendor.vendor_data.product.product_data.product_name == PrestaShop}
        {% assign type = Core %}
        {% assign module_name = cve.affect.vendor.vendor_data.product.product_data.product_name %}
    {% else %}
        {% assign type = Modules %}
    {% endif %}

    {% assign version = cve.affect.vendor.vendor_data.product.product_data.version.version_data.version_value | split: ", " %}
    {% if version.size == 2 %}
        {% assign version_min = version | first %}
        {% assign version_max = version | first %}
    {% else %}
        {% assign whatkind = version | slice: 0 %}
        {% if whatkind == "<" %}
            {% assign version_max = version %}
        {% else %}
            {% assign version_max = version %}
        {% endif %}
    {% endif %}

    {% assign vendor_name = cve.affect.vendor.vendor_data.vendor_name %}
    {% assign description = cve.description.description_data.value %}
    {% assign github_link = cve.references.reference_data.url %}

{% endfor %}