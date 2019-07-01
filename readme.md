[![Build Status](https://travis-ci.org/romanopablo/mutant-dna-analizer-api.svg?branch=master)](https://travis-ci.org/romanopablo/mutant-dna-analizer-api)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/aae820713e2a4fa59a479a1a82826710)](https://www.codacy.com/app/romanopablo/mutant-dna-analizer-api?utm_source=github.com&utm_medium=referral&utm_content=romanopablo/mutant-dna-analizer-api&utm_campaign=Badge_Coverage)

# Analizador de ADN mutante

Magneto quiere reclutar la mayor cantidad de mutantes para poder luchar contra los X-Mens.

Te ha contratado a ti para desarrollar una Api REST que permita verificar si un ADN es mutante o humano y obtener estadisticas de todas las consultas.

## Tecnologías 

-  [Lumen](https://lumen.laravel.com/)
-  [MySql](https://www.mysql.com/)
-  [PhpUnit](https://phpunit.de/)

## Funcionamiento 
El proyecto se encuentra corriendo sobre una vm de EC2 en AWS. 
URL AWS:([http://ec2-54-88-178-196.compute-1.amazonaws.com](http://ec2-54-88-178-196.compute-1.amazonaws.com))

### Analizador de ADN

[/mutants](http://ec2-54-88-178-196.compute-1.amazonaws.com/mutants)

Request: 
-  POST

Request body ejemplo:

```
  {“dna”:["ATGCGA","CAGTGC","TTATGT","AGAAGG","CCCCTA","TCACTG"]}
```

Response mutante:

```
  200 OK
```
Response humano:
```
  403 Forbidden
```

### Estadisticas

[/stats](http://ec2-54-88-178-196.compute-1.amazonaws.com/stats)

Request ejemplo: 
-  GET

Response:

```
200 (application/json)
{
    count_mutant_dna: 4,
    count_human_dna: 1,
    ratio: 0.8
}
```

### Instrucciones para correr en su entorno local

Es necesario tener instalado PHP >= 7.1.3, MySql v5.7 y Composer para la gestión de dependencias.

-  Clonar el repositorio.
-  Crear crear un archivo .env usando como ejemplo .env.example.
-  Cambiar los valores DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME y DB_PASSWORD del archivo .env con los datos correspondientes a su MySql local.
-  Ejecutar los siguientes comandos:
```
composer install
php artisan migrate
```
-  Para servir el proyecto:
```
php -S localhost:8000 -t public
```
URL local: http://localhost:8000

### Tests

Se escribieron usando la librería PhpUnit, se pueden ejecutar desde la raíz del proyecto con el comando:
```
php vendor/bin/phpunit --stderr
```
(Es necesario tener el entorno local configurado)

#### Cobertura

La cobertura de código se puede ver en el badge al principio de este readme, se realizo con la herramienta Codecov. 
