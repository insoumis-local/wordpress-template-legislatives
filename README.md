# Contribuer

Thème basé sur https://github.com/roots/sage. Se référer à la [documentation](https://roots.io/sage/docs/theme-installation/) pour l'installer et le modifier.

Pour faire une mise à jour, modifier le fichier `CHANGES.md` (infos) et `style.css` (version). La mise à jour sera détectée par chaque site grâce au plugin `github-updater`.

# Thème Législatives Insoumises

Choses notables :
* Dans "Apparence > Personnaliser > FI 2017" il est possible de définir les infos de base pour afficher le cartouche d'accueil.
 Ce cartouche ne s'affiche que sur la page d'accueil, si celle-ci n'utilise pas le template "Home" ou le template "Blue card only". 
 Pour modifier ce cartouche, voir le fichier _templates/header-home.php_.
* Le template de contenu "Blue card only" correspond à la home de https://lafranceinsoumise.fr
* Le template de contenu "Home" permet d'utiliser l'image mise en avant comme fond et le texte comme contenu de la barre positionnée sur l'image. Il permet donc de faire une page d'accueil différente du modèle fourni par le cartouche.
* Il y a trois zones pouvant accueillir des widgets :
  * Sidebar : la barre latérale droite sur les pages qui en disposent
  * Pre Footer : la zone bleue en base de page avant le footer
  * Pied de page : le footer tout en bas de page
* Il y a quatre zones pouvant accueillir des menus :
  * Navigation Primaire : barre blanche à droite du logo sur toutes les pages
  * Secondary Navigation : barre orange sous la Navigation Primaire
  * Blue card only Left Nav : espace à gauche de la zone bleue sur le template "Blue card only"
  * Blue card only Right Nav : espace à droite de la zone bleue sur le template "Blue card only"
