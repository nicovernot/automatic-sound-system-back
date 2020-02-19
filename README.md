# BlidTest_Api

1) Creer un fichier docker-compose.yml avec le contenu suivant

version: '2'

services:
  myapp:
    image: 'bitnami/symfony:1'
    ports:
      - '8001:8000'
    volumes:
      - '.:/app'
    depends_on:
      - mariadb
  mariadb:
    image: 'bitnami/mariadb:10.3'
    environment:
      - ALLOW_EMPTY_PASSWORD=yes
2) éffectuer la commande  suivante :
docker-compose up -d

