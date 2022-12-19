tableau ou une page par cve ?

aller dans ../list/core et ../list/modules et afficher tout les CVEs:

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

{% include test.md %}