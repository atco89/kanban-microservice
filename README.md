# Kanban Microservice

A Kanban board is one of the tools that can be used to implement Kanban to manage work at a personal or organizational level.

### Prerequisites

* GNU Make;
* Docker;

### Installing 

##### Installing OpenAPI - for development

Run the following command, inside openapi directory, in order to clone OpenAPI generator.

```
make install
```

We are still in openapi directory. Following command is used to generate OpenAPI project in Laravel:

```
make gen
```

##### Installation step - for all

Now go back to root of project and run following to docker build containers (webserver, database, swagger-ui and adminer):

```
make install
```

After docker containers are up, we should have access to the following:

1) https://localhost/api/v1 - API base URL;
2) http://localhost:8001 - Swagger UI;
3) http://localhost:8002 - Adminer;

## Coding standard

Coding style is according to [PSR-2](https://www.php-fig.org/psr/psr-2/) standards.

## Built With

* [Docker](https://www.docker.com/)
* [MySQL 5.7](https://dev.mysql.com/doc/relnotes/mysql/5.7/en/);
* [PHP 7.4](https://www.php.net/ChangeLog-7.php#7.4);
* [Laravel](https://laravel.com/)
* [OpenAPI](https://swagger.io/specification/)

## Author

* **Aleksandar Rakić** - *Initial work* - [aleksandar.rakic@yahoo.com](mailto:aleksandar.rakic@yahoo.com)

## License

This project is licensed under the MIT License - see the [LICENSE.md](documentation/license.md) file for details.