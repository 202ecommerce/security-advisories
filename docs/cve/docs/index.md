---
layout: default
title: 202 ecommerce Security Advisories
is_index: true
is_cve_page: true
to_home_page: true
---

# CVEs list

1. [Core type CVEs](#core-type-cves)
2. [Module type CVEs](#module-type-cves)

## Core type CVEs:

{% assign all_cve = site.data.cve %}

<table>
  <thead>
    <tr>
      <th>Identifier</th>
      <th>Version</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>

{% for cve in all_cve %}

    {% assign module_name = cve.affects.vendor.vendor_data[0].product.product_data[0].product_name %}

    {% if module_name == 'PrestaShop' %}

        {% assign identifier = cve.CVE_data_meta.ID %}
        {% assign version = cve.affects.vendor.vendor_data[0].product.product_data[0].version.version_data[0].version_value %}
        {% assign description = cve.description.description_data[0].value %}

<tr>
  <td><a href="https://cve.mitre.org/cgi-bin/cvename.cgi?name={{ identifier }}">{{ identifier }}</a></td>
  <td>{{ version }}</td>
  <td>{{ description }}</td>
</tr>

    {% endif %}
{% endfor %}

  </tbody>
</table>


## Module type CVEs:

{% assign all_cve = site.data.cve %}

<table>
  <thead>
    <tr>
      <th>Identifier</th>
      <th>Module name</th>
      <th>Version</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>

{% for cve in all_cve %}

    {% assign module_name = cve.affects.vendor.vendor_data[0].product.product_data[0].product_name %}

    {% if module_name != 'PrestaShop' %}

        {% assign identifier = cve.CVE_data_meta.ID %}
        {% assign version = cve.affects.vendor.vendor_data[0].product.product_data[0].version.version_data[0].version_value %}
        {% assign description = cve.description.description_data[0].value %}

<tr>
  <td><a href="https://cve.mitre.org/cgi-bin/cvename.cgi?name={{ identifier }}">{{ identifier }}</a></td>
  <td>{{ module_name }}</td>
  <td>{{ version }}</td>
  <td>{{ description }}</td>
</tr>

    {% endif %}
{% endfor %}

  </tbody>
</table>
