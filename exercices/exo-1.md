# Exercice 1 - Compréhension fonctionelle

dans cet exercice vous pouvez installer des bundles sauf api platform.

## Part 1
Créer des auteurs qui ont un nom et un prénom ainsi qu'une liste de livres.

## Part 2

Faire une route pour récupérer les auteurs filtrables par un champ de recherche sur le nom ou le prenom, cette route renverra le prénom des auteurs ainsi que le nom de ses livres, et le nombre de livres de chaque auteurs.

 - Route : GET http://localhost:8080/api/author/?name=toto
  
## Part 3
Faire une route pour créer des auteurs en fournissant son nom, son prénom ainsi que la liste de ses livres.

 - Route : POST http://localhost:8080/api/author/
 - Jeux de données :
```json
[
    {
    "firstName": "toto",
    "lastName": "tutu",
    "books": [
        {"title": "bouquin 1", "resume": "bla bla bla"},
        {"title": "bouquin 2", "resume": "pop pop pop"}
    ]
    }
]
```
## Part 4
Créer une query GRAPHQL pour récupérer un auteur en mettant à disposition le nom des auteurs, ainsi que ses livres.