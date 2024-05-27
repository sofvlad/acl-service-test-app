# ACL Service Test App

Access Control Service implemented without frameworks

## Features
* PSR-7 by guzzlehttp/psr7
* PSR-11 by league/container
* Routing by league/route
* Migrations by robmorgan/phinx
* ENV support by josegonzalez/dotenv
* ORM by cakephp/orm
* OpenAPI to validate requests
* Docker compose support
* ~~PHPUnits~~
* ~~OpenAPI UI~~

## Clone repo
```
git clone https://github.com/sofvlad/acl-service-test-app
```

## Docker Deploy
```
composer install
cp .env.example .env
docker-compose build
docker-compose up
docker exec -it php /bin/sh
vendor/bin/phinx migrate
vendor/bin/phinx seed:run
```

## Endpoints
> [!NOTE]
> Full describe of API you can investigate in `config/api/schema.yaml`

Full describe `config/api/schema.yaml`
User Endpoints
- /api/users
- /api/user/{id}
- /api/user/{id}/add_roles
- /api/user/{id}/remove_roles

Role Endpoints
- /api/roles
- /api/role/{id}
- /api/role/{id}/add_users
- /api/role/{id}/remove_users
- /api/role/{id}/add_permissions
- /api/role/{id}/remove_permissions

Permission Endpoints
- /api/permissions
- /api/permission/{id}
- /api/permission/{id}/add_roles
- /api/permission/{id}/remove_roles

Example 1:
```
http://localhost/role/2/add_users
Body:
[
    "user1@test.local",
    "user3@test.local"
]
```

Example 2:
```
http://localhost/role/2/add_permissions
Body:
[
    "send_messages",
    "debug"
]
```
