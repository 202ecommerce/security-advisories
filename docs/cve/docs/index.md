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
      <th>Title</th>
      <th>Identifier</th>
      <th>Version</th>
      <th>Vendor name</th>
      <th>Description</th>
      <th>Github link</th>
    </tr>
  </thead>
  <tbody>

{% for cve in all_cve %}

    {% assign module_name = cve.affects.vendor.vendor_data[0].product.product_data[0].product_name %}

    {% if module_name == 'PrestaShop' %}

        {% assign title = cve.CVE_data_meta.TITLE %}
        {% assign identifier = cve.CVE_data_meta.ID %}
        {% assign version = cve.affects.vendor.vendor_data[0].product.product_data[0].version.version_data[0].version_value %}
        {% assign vendor_name = cve.affects.vendor.vendor_data[0].vendor_name %}
        {% assign description = cve.description.description_data[0].value %}
        {% assign github_link = cve.references.reference_data[0].url %}

<tr>
  <td>{{ title }}</td>
  <td>{{ identifier }}</td>
  <td>{{ version }}</td>
  <td>{{ vendor_name }}</td>
  <td>{{ description }}</td>
  <td><a href="{{ github_link }}">{{ github_link }}</a></td>
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
      <th>Title</th>
      <th>Identifier</th>
      <th>Module name</th>
      <th>Version</th>
      <th>Vendor name</th>
      <th>Description</th>
      <th>Github link</th>
    </tr>
  </thead>
  <tbody>

{% for cve in all_cve %}

    {% assign module_name = cve.affects.vendor.vendor_data[0].product.product_data[0].product_name %}

    {% if module_name != 'PrestaShop' %}

        {% assign title = cve.CVE_data_meta.TITLE %}
        {% assign identifier = cve.CVE_data_meta.ID %}
        {% assign version = cve.affects.vendor.vendor_data[0].product.product_data[0].version.version_data[0].version_value %}
        {% assign vendor_name = cve.affects.vendor.vendor_data[0].vendor_name %}
        {% assign description = cve.description.description_data[0].value %}
        {% assign github_link = cve.references.reference_data[0].url %}

<tr>
  <td>{{ title }}</td>
  <td>{{ identifier }}</td>
  <td>{{ module_name }}</td>
  <td>{{ version }}</td>
  <td>{{ vendor_name }}</td>
  <td>{{ description }}</td>
  <td><a href="{{ github_link }}">{{ github_link }}</a></td>
</tr>

    {% endif %}
{% endfor %}

  </tbody>
</table>