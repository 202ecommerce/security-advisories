---
layout: default
title: 202 ecommerce Security Advisories
is_index: true
is_cve_page: true
to_home_page: true
---

{% assign allcve = site.data.cve %}
{% assign types = "core, module" | split: ", " %}

{% for type in types %}

    {% capture title %}
        **{{ type }} type CVEs:**
    {% endcapture %}
    {{ title | makdownify}}

    {% for cve in allcve %}
        {% if type == "core" %}
            {{ cve.CVE_data_meta.TITLE }} | {{ cve.affect.vendor.vendor_data.0.product.product_data.1.version.version_data.0.version_value }}

        {% endif %}
    {% endfor %}
{% endfor %}
