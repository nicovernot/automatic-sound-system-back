# BlidTest_Api


## Pré-requis

## installation du Workspace de dev
1) Créer un repertoire `automatic-sound-system-back` dans votre workspace.
2) Déposer dans le dossier précédement créé le fichier `/dockerfile/docker-compose.yml`.
3) Effectuer la commande suivante: `docker-compose up -d`
Cette commande lance les deux containers (Symphony et MariaDB)
4) Une fois le processus terminé (le dossier `myapp` est présent et rempli), supprimmer le dossier `myapp` : `rm -rf myapp/`
5) Cloner le repo dans un dossier `myapp` : `git clone git@github.com:nicovernot/automatic-sound-system-back.git myapp`.
6) Effectuer la commande suivante: docker ps -a afin de récuperer l id du container symphony
7) Effectuer la commande suivante: docker start {id_container_symphony}
8) Puis : docker exec -it {id_container_symphony} /bin/bash 
9) Puis dans le promt Docker : cd myapp/ puis composer install
10) Browser l'url : http://localhost:8001/
11) votre espace de travail est à présent dans le dossier myapp

