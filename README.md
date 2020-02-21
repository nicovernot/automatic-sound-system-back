[![Build Status](https://cloud.drone.io/api/badges/nicovernot/automatic-sound-system-back/status.svg)](https://cloud.drone.io/nicovernot/automatic-sound-system-back)

# BackendMusicass 


## Pré-requis
- installer docker sur votre machine

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

## Installation de Symfony
Installer les paquets PHP :
```bash
$> composer install
```

## Installation de la BDD
Vérifier que la variable d'environnement `DATABASE_URL` est bien définie.
Pour Docker, utiliser :
```text
DATABASE_URL=mysql://root@mariadb:3306/bitnami_myapp
```

Si vous n'avez pas encore la base, créez la:
```bash
$> php bin/console doctrine:database:create
```

Jouer les migrations :
```bash
$> php bin/console doctrine:migrations:migrate
```

## Installation LexikJWT
Installer les clés SSH pour LexikJWT.
Pour cela, suivre la [doc du package](https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#generate-the-ssh-keys).

Nous stockerons la variable d'environnement `JWT_PASSPHRASE` contenant la phrase secrete pour les clés SSH. 
