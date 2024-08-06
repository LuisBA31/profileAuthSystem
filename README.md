# Profile Authentication System

## Descripción
Profile Authentication System es un proyecto diseñado para gestionar la autenticación y el manejo de perfiles de usuarios. Proporciona una solución segura y escalable para la creación y administración de cuentas de usuario, autenticación y autorización.

## Tabla de Contenidos
- [Instalación](#instalación)
- [Uso](#uso)
- [Configuración](#configuración)
- [Contribuir](#contribuir)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Tecnologías Utilizadas](#tecnologías-utilizadas)
- [Autores](#autores)
- [Licencia](#licencia)
- [Referencias](#referencias)

## Instalación

### Requisitos Previos

- PHP 5.6 (recomendado) o superior
- MySQL

### Pasos de Instalación

1. Clonar el repositorio:
    ```bash
    git clone https://github.com/LuisBA31/profileAuthSystem.git
    ```
2. Instalar dependencias:
    ```bash
    composer install
    ```
3. Importar la base de datos:
    ```
    - El archivo de base de datos se encuentra como: login.sql
    - Conéctate a tu servidor de base de datos.
    - Crea una base de datos con el mismo nombre que la base de datos a importar.
    - Importa la base de datos y selecciona el archivo: login.sql
    - Inicia la importación.
    ```
4. Configurar la base de datos en el archivo `mysqlConn.php`:
    ```
    servername = tu_servidor
    username = tu_usuario
    password = tu_contraseña
    dbname = login
    ```
5. Iniciar el proyecto:
    ```
    En tu navegador escribe http://localhost/rutaDelProyecto
    ```

## Uso

Para acceder a la aplicación, abre tu navegador y ve a `http://localhost`. Regístrate o inicia sesión para comenzar a usar el sistema.

### Creación de usuarios

1. De momento los usuarios solo se registran desde la base de datos.

2. Las contraseñas deben estar encriptadas por hash.

3. Los campos nombre, apPaterno, apMaterno, telefono e email pueden ser nulos.

## Configuración

Asegúrate de configurar correctamente el archivo `mysqlConn.php` con tus credenciales de base de datos y otras configuraciones necesarias.

## Contribuir

1. Hacer un fork del repositorio.
2. Crear una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realizar los cambios y hacer commit (`git commit -am 'Agregar nueva funcionalidad'`).
4. Hacer push a la rama (`git push origin feature/nueva-funcionalidad`).
5. Crear un pull request.

## Estructura del Proyecto

/.gitattributes - Archivo de configuración para atributos de Git.
cerrarSesion.php - Script para cerrar sesión de usuario.
eliminarDisp.php - Script para eliminar dispositivos.
estilos.css - Archivo de estilos CSS.
index.php - Página de inicio del proyecto.
login.sql - Script SQL para la base de datos de inicio de sesión.
loginForm.php - Formulario de inicio de sesión.
mysqlConn.php - Archivo de conexión a la base de datos MySQL.
obtenerImagen.php - Script para obtener imágenes.
pinForm.php - Formulario para ingreso de PIN.
principal.php - Página principal del sistema.
README.md - Archivo README del proyecto.
sesion.php - Script de gestión de sesiones.
validacionForm.js - Archivo JavaScript para validación de formularios.
validacionForm.php - Script PHP para validación de formularios.
validacionInfoForm.js - Archivo JavaScript para validación de información de formularios.
validacionInfoForm.php - Script PHP para validación de información de formularios.
validacionPin.js - Archivo JavaScript para validación de PIN.
validacionPin.php - Script PHP para validación de PIN.

## Tecnologías utilizadas

- Php
- MySQL
- Bootstrap
- JavaScript

## Autores

- Luis Beltrán - *Trabajo incial* - [LuisBA31](https://github.com/LuisBA31)

## Licencia

Este proyecto está licenciado bajo la Licencia [MIT](https://choosealicense.com/licenses/mit/) 

## Referencias
 - [Documentación de PHP](https://www.php.net/docs.php)
 - [Documentación de Bootstrap](https://getbootstrap.com/docs/5.0)
 - [Documentación de JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)