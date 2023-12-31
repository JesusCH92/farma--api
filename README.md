# FARMA API

## Stack
Este proyecto esta hecho con PHP 8.2(Symfony6) + Nginx + MySQL 8

## Configuración del entorno para desplegar el proyecto
**Debes tener instalado docker y docker compose en tu equipo**

- [ ] Instalar la network de los contenerdores:
```shell
docker network create app-network
```

- [ ] Levantar los contenedores
```shell
docker-compose -p farma up -d
```

- [ ] Accedemos al contenedor de PHP
```shell
docker exec -it php-fpm bash
```

- [ ] **Cuando entremos en modo interactivo**

**Instalacion de dependencias y migraciones**
```bash
composer install
php bin/console doctrine:migrations:migrate
```

- [ ] Test

**Se hace desde el contenedor de PHP, y despues de instalar las dependencia**
```bash
php bin/phpunit --testdox
```

## Acceso al sistema

Después de desplegar el proyecto correctamente, debe acceder al siguiente enlace

[`http://localhost:8080`](http://localhost:8080)

Para ver la documentación de las apis en formato json:

[`Documentación-apis-en-json`](http://localhost:8080/api/doc.json)

Para ver la documentación de las apis en formato UI:

[`Documentación-apis-con-UI`](http://localhost:8080/api/doc)
