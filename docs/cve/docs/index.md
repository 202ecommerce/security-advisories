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

    {% assign title = cve.CVE_data_meta.TITLE %}
    {{ title }}
    {{ cve.CVE_data_meta.TITLE }}


    {% if is_core %}
        {% assigne cvecore %}
    {% elsif is_module %}
        {% assigne cvemodules %}
    {% endif %}
{% endfor %}











# CVEs list

1. [Core type CVEs](#core-type-cves)
2. [Module type CVEs](#module-type-cves)

## Core type CVEs:



## Module type CVEs:



    
