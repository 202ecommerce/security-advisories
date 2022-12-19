tableau ou une page par cve ?


générer les fichier de datas dans _CVE_datas
/!\ : les démarer par --- title: core --- et --- title: modules --- respectivement


 - tableau :
    - aller dans ../list/core
    - recuperer tout les paths dans une array
    - pour chaque élément, récupérer les données voulues
    - les afficher dans une ligne du tableau
    - faire pareil pour ../list/modules

 - pages :
    - aller dans ../list/core
    - recuperer tout les paths dnas une array
    - utiliser une foreach pour créer les liens vers les pages
    - faire pareil pour ../list/modules

{% for data in site.CVE_datas %}
    {{ data.content }}
{% endfor %}