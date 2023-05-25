
# TFG DAW

Este es el TFG realizado para el Ciclo Superior de Desarrollo de Aplicaciones Web



## Instalación

Para la instalación del proyecto se han usado y serán requisitos mínimos las siguientes aplicaciones:
- Composer 2.5.5
- Laravel 10.7.1
- XAMPP 3.3.0

Una vez se hayan instalado esas aplicaciones se podrá clonar el proyecto con el comando:
```bash
  composer install
```
Lo cual creará la carpeta vendor.

Con la carpeta vendor creada se deberá configurar el archivo .env para que el proyecto se conecte a la base de datos.

Para importar la base de datos se puede usar PHPMyAdmin e importar el SQL proporcionado o lanzar las migraciones de Laravel que contiene el proyecto con el siguiente comando:
```bash
  php artisan migrate:fresh
```

También se pueden realizar las instalaciones por separado en vez de usar XAMPP, la única diferencia es que hay que instalar todo lo necesario manualmente y configurarlo.


## Ejecución

Para ejecutar el proyecto y probarlo se deberá usar el comando
```bash
  php artisan serve
```
De esta manera se servirá en local y nos proporcionará acceso a las siguientes rutas:
  - **GET** →          *api/expenses*
  - **GET** →        *api/finances*
  - **GET** →        *api/finances/{finance}*
  - **PUT** →      *api/finances/{finance}*
  - **DELETE** →          *api/finances/{finance}*
  - **POST** →            *api/households*
  - **GET** →        *api/households/balance*
  - **POST** →            *api/households/join/{uuid}*
  - **GET** →        *api/households/members*
  - **DELETE** →          *api/households/{household}*
  - **GET** →        *api/income*
  - **POST** →            *api/login*
  - **POST** →            *api/logout*
  - **GET** →        *api/purchases*
  - **POST** →            *api/purchases*
  - **GET** →        *api/purchases/{purchase}*
  - **PUT** →       *api/purchases/{purchase}*
  - **DELETE** →          *api/purchases/{purchase}*
  - **POST** →            *api/register*
  - **PUT** →             *api/user*
  - **GET** →        *api/user/household*
  - **DELETE** →          *api/user/leavehousehold*
  - **GET** →        *api/user/profile*
  - **GET** →        *finances*
  - **GET** →        *finances/account*
  - **GET** →        *finances/expenses*
  - **GET** →        *finances/history*
  - **GET** →        *finances/household*
  - **GET** →        *finances/income*
  - **GET** →        *finances/logout*
  - **GET** →        *finances/purchases*
  - **GET** →        *finances/user*
  - **GET** →        *login*
  - **GET** →        *register*
## Autor

- [@ATorada](https://www.github.com/ATorada)

