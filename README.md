TodoList avec symfony 3.4

Travailler avec Git :

* Clone le projet :
```sh
$ git clone git@github.com:Mathieu33260/todolist-symfony.git
```
ou avec https
```sh
$ git clone https://github.com/Mathieu33260/todolist-symfony.git
```
* Au moment de commit :
```sh
$ git checkout -b nom_de_la_feature
```
ça crée une nouvelle branche et t'y amènes dessus
* On ajoute les nouveaux fichiers :
```sh
$ git add *
```
des warnings peuvent apparaitre mais c'est pas important 
du moment qu'ils ont bien été ajouté.<br>
Hésites pas à checker si ils ont été ajouté avec :
```sh
$ git status
```
Si ils sont marqués comme ``untracked`` c'est qu'ils sont
pas ajouté et il faut donc faire un ``git add *``.
* Ensuite on commit :
```sh
$ git commit -m "Le message décrivant ce que t'as fait"
```
* Puis on push :
```sh
$ git push -u origin nom_de_la_feature
```
A partir de là ton travail est sur le dépôt distant (github).
* On retourne sur la branche ``master``:
```sh
$ git checkout master
```
* On récupère le travail fait pendant qu'on travaillait sur 
notre branche :
```sh
$ git pull
```
* Puis on retourne à nouveau sur notre branche :
```sh
$ git checkout nom_de_la_feature
```
* Il faut maintenant mettre à jour ta branche pour la fusionner
 avec la branche ``master`` sans faire de conflits :
```sh
$ git rebase -i master
```
Le ``-i`` signifie interactif, dans le sens ou git applique
chacun de tes commits un par un jusqu'à avoir totalement ``rebase``
ta branche avec ``master``. Très pratique pour résoudre d'éventuels
conflits, mais un peu long si t'as beaucoup de commits sur ta branche.
* On a réécrit l'historique de la branche, il faut donc la push
à nouveau :
```sh
$ git push --f
```
Le ``--f`` signifie force, car git n'aime pas trop 
qu'on réécrive l'historique. Après un ``rebase`` et un 
``push --f``, si on est plusieurs à travailler sur la branche
en question, les autres développeurs doivent supprimer 
leur branche (celle qui vient d'être ``rebase``), puis faire
un ``git pull`` pour récupérer la branche à nouveau.
* Pour finir faut aller sur 
<a href="https://github.com/Mathieu33260/todolist-symfony/branches">la liste des branches</a>
du projet (le lien y amène direct), cliquer sur "New pull request"
, assigner un "Reviewer" (en haut à droite) et cliquer sur "Create pull request".
* Le "Reviewer" regardera ensuite les changements apportés par
la branche et approuvera ou non ces changements.
* Si les changements sont approuvés, il faut cliquer sur "Merge pull request",
la branche ``nom_de_la_feature`` sera ainsi merger dans ``master``.
* En retournant sur la branche ``master`` et en faisant 
un ``git pull`` on retrouve les changements apportés.
