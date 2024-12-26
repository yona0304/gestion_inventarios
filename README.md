## Sistema Inventario

Este sistema de gestión de inventarios, se puede desde registrar, hasta editar y reportar novedades acerca del producto registrado en el inventario, tambien te deja registrar personal, para poder asignar le un equipo, este personal esta dividido por dos roles al momento de crearlo, el primero es "Administrador" este tiene permiso de ingresar al sistema, por medio de un correo electronico, que se registra y una contraseña que se crea, apartir de la identificacion suministrada del personal, el otro rol "Personal" este no tiene ningun beneficio, solo cuenta para poder asignar algun equipo del inventarios, pero no tiene ningun acceso como el administrador de poder modificar o editar algo.

Explicación del sitio web:

- Inicio: En el apartado de inicio de sesion, encontraremos unas graficas referente a los productos registrados, las asignaciones realizadas y productos que se encuentran en mantenimiento o retiro.
- Registros: En este apartado, puedes acceder a tres módulos clave: uno dedicado al registro de nuevos productos, el segundo dedicado al registro de vehiculos que son pertenecientes a la empresa o prestados, y otro para el registro y administración de usuarios del sistema.
- Asignaciones: Aquí podrás asignar equipos a los usuarios o realizar retiros de asignaciones previas de forma fácil y rápida, solo ingresando los datos solicitados, tambien podras llevar un registro o historial computo de los portatiles o aquellos equipos pertenecientes a esa categoria.
- Dotaciones: este apartado se encuentran dos modulos, uno es la asignacion de la dotacion al personal, por medio del cargo que tiene, y el otro es el modulo de consulta por medio del "Id del profesional", para saber que equipos ya tiene asignados o si hace falta.
- Alquiler: Este apartado, esta dedicado solo a los equipos pertenecientes a los profesionales, en la cual el profesional le hace el alquiler de su equipo a la empresa, recibiendo un valor monetario mensual, registro de forma individual o masivo, por medio de un archivo (CSV-utf8 delimitado por comas).
- Categoria: registra o desactiva la categoria perteneciente, en el cual valida si hay equipos asignados, de ser asi, no sera posible realizar la desactivación de la categoria y su prefijo.
- Novedades: Este módulo te permite gestionar y visualizar las novedades del sistema. Podrás consultar una lista de novedades registradas y utilizar el botón "Registrar" para añadir nuevas entradas.
- Listas: En esta sección, encontrarás dos listas principales: una que muestra todas las asignaciones actuales y otra que detalla los productos registrados. Estas listas están diseñadas para facilitar la visualización y gestión de la información.
- Cambiar clave: formulario de cambio de clave del perfil activo.
- Salir: Un botón fácilmente accesible que te permite cerrar sesión de forma rápida y segura.

## Pasos de intalación del "Sistema Inventario"

- Descargar proyecto de inventario, en la carpeta de **xampp** dentro de **htdocs**
- Git Bash, dirigirnos hasta la ruta de la carpeta donde se guardo el proyecto, ej: **c:/xampp/htdocs/nombre_de_la_carpeta**
- Git Bash, escribimos **composer install**
- Git Bash, escribimos **cp .env.example .env**
- Git Bash, generamos un clave de aplicación unica **php artisan key:generate**
- Git Bash, migración base de datos **php artisan migrate**
- Git Bash, instalamos dependencias **npm install**
- Git Bash, ejecución del servidor **php artisan serve**

## Herramientas utilizadas

- **[Composer](https://getcomposer.org/)**
- **[Node js](https://nodejs.org/en)**
- **[Xampp](https://www.apachefriends.org/es/index.html)**
- **[Laravel](https://laravel.com/)**
- **[Tailwind](https://tailwindcss.com/)**
- **[Sweetalert2](https://sweetalert2.github.io/)**
- **[Laravel-Excel](https://laravel-excel.com/)**


## Colaboradores
- **[Yonatan Vides](https://github.com/yona0304)**
- **[Kevin Llenos](https://github.com/Kelc098)**

