# Plantilla para Wordpress con docker

## Instalación

```
git clone git@git.irontec.com:internet/wordpress-docker-template.git
git remote remove origin
git remote add origin git@git.irontec.com:grupo/proyecto.git
git add .
git commit -m "Initial commit"
git push -u origin master
```

## Configuración

Antes de levantar el entorno hay que configurar los siguietnes archivos:

- docker/.env
- docker/ha-proxy/haproxy.cfg
- utils/credentials.sh

Los archivos están explicados y se entiende bastante bien lo que hay que cambiar.

## Autoconfiguración

Para facilitar la configuración del entorno se ha creado el script initialize.sh.

Hay que ejecutarlo desde la carpeta docker:

```
cd docker
./initialize.sh
```

El script pregunta por la infromación necesaria y hace las sustituciones en los archivos correspondientes.

## Levantar el entorno

Una vez configurado, basta con hacer docker-compose up desde la carpeta docker:

```
cd docker
docker-compose up -d && docker-compose logs -f --tail 50
```

Datos para entrar en wp-admin:
- usuario: admin
- contraseña: F4rs4-f4rS4


