---
layout: default
title: 202 ecommerce Security Advisories
is_index: true
is_cve_page: true
to_home_page: true
---

générer les fichier de datas dans _cvedatas
/!\ : les préparer celon le modèle suivant :

---
title: core / module
module_name:
version_min:
version_max:
vendor_name:
description:
url:
---

1. CVEs de type Core :

  {% for data in site.cvedatas %}
    {% if data.title == "core" %}
      **{{ data.module_name }}** | {{ data.version_min }} | {{ data.version_max }} | {{ data.vendor_name }} | {{ data.description }} | {{ data.url }}
    {% endif %}
  {% endfor %}

<br>

2. CVEs de type modules :

  {% for data in site.cvedatas %}
    {% if data.title == "module" %}
      **{{ data.module_name }}** | {{ data.version_min }} | {{ data.version_max }} | {{ data.vendor_name }} | {{ data.description }} | {{ data.url }}
    {% endif %}
  {% endfor %}
