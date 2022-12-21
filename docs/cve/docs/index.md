---
layout: default
title: 202 ecommerce Security Advisories
is_index: true
is_cve_page: true
to_home_page: true
---

{% assign allcve = site.data.cve %}
{% assign types = "core, module" | split: ", " %}

{% paginate allcve by 35 %}
    {% for type in types %}

    **{{ type }} type CVEs:**

        {% for cve in allcve %}
            {% if type == core %}

                {{ cve.CVE_data_meta.TITLE }} | {{ cve.affect.vendor.vendor_data.product.product_data.version.version_data.version_value }} 

            {% assign title = cve.CVE_data_meta.TITLE %}
            {% assign version = cve.affect.vendor.vendor_data.product.product_data.version.version_data.version_value %}
            {% assign vendor_name = cve.affect.vendor.vendor_data.vendor_name %}
            {% assign description = cve.description.description_data.value %}
            {% assign github_link = cve.references.reference_data.url %}

            {% if cve.affect.vendor.vendor_data.product.product_data.product_name == PrestaShop}
                {% assign module_name = cve.affect.vendor.vendor_data.product.product_data.product_name %}

                **{{ TITLE }}** | {{ module_name }} | {{ version }} | {{ vendor_name }} | {{ description }} | {{ github_link }}

            {% else %}

                **{{ TITLE }}** | {% if version.size == 2 %} {{ version }} {% else %} {{ version }} {% endif %} | {{ vendor_name }} | {{ description }} | {{ github_link }}

            {% endif %}

        {% endfor %}
{% endpaginate %}
