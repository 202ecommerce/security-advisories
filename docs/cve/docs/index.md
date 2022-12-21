---
layout: default
title: 202 ecommerce Security Advisories
is_index: true
is_cve_page: true
to_home_page: true
---

{% assign allcve = site.data.cve %}
{% assign types = "core, module" | split: ", " %}

{% assign cvecore = cvecore | split: '' %}
{% assign cvemodules = cvemodules | split: '' %}

{% for cve in allcve %}

    {{ cve.affects.vendor.vendor_data | json }}
    {% break %}

    {% if is_core %}
        {% assign cvecore = cvecore | push: cve %}
    {% elsif is_module %}
        {% assign cvemodules = cvemodules | push: cve %}
    {% endif %}

{% endfor %}



# CVEs list

1. [Core type CVEs](#core-type-cves)
2. [Module type CVEs](#module-type-cves)

## Core type CVEs:

{% for cve in cvecore %}

    {% assign title = cve.CVE_data_meta.TITLE %}

{% endfor %}

## Module type CVEs:

{% for cve in cvemodules %}

    {% assign title = cve.CVE_data_meta.TITLE %}

{% endfor %}
