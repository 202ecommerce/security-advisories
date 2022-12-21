---
layout: default
title: 202 ecommerce Security Advisories
is_index: true
is_cve_page: true
to_home_page: true
---

{% assign allcve = site.data.cve %}
{% assign types = "core, module" | split: ", " %}

{% assign cvecore = '' %}
{% assign cvemodules = cvemodules | split: '' %}

{% for cve in allcve %}

    {% assign module_name = cve.affects.vendor.vendor_data %}
    {{ module_name | split: '{' | first }}

    {% assign module_name2 = module_name.product.product_data %}
    {{ module_name }}
    
    {% assign module_name3 = module_name2.product_name %}
    {{ module_name }}

    {% break %}

    {% if module_name == prestashop %}
        {% assign cvecore = cvecore | push: cve %}
    {% else %}
        {% assign cvemodules = cvemodules | push: cve %}
    {% endif %}

{% endfor %}


# CVEs list

1. [Core type CVEs](#core-type-cves)
2. [Module type CVEs](#module-type-cves)

## Core type CVEs:

{% for cve in cvecore %}

    {% assign title = cve.CVE_data_meta.TITLE %}
    {% assign version = cve.affects.vendor.vendor_data %}
    {% assign vendor_name = cve.affects.vendor.vendor_data | last %}
    {% assign description = cve.description.description_data. %}
    {% assign github_link = cve.references.references_data. %}

    **{{ data.title }}** | {{ data.version }} | *{{ data.vendor_name }}* | {{ data.description }} | {{ data.github_link }}

{% endfor %}

## Module type CVEs:

{% for cve in cvemodules %}

    {% assign title = cve.CVE_data_meta.TITLE %}

    {% assign module_name = cve.affects.vendor.vendor_data | first %}
    {% assign module_name = module_name.product_data | first %}

    {% assign version = cve.affects.vendor.vendor_data %}
    {% assign vendor_name = cve.affects.vendor.vendor_data %}
    {% assign description = cve.description.description_data. %}
    {% assign github_link = cve.references.references_data. %}

    **{{ data.title }}** | {{ data.module_name }} | {{ data.version }} | *{{ data.vendor_name }}* | {{ data.description }} | {{ data.github_link }}

{% endfor %}
