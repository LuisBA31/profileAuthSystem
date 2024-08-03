# profileAuthSystem

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/LuisBA31/profileAuthSystem.git

2. Importa la base de datos:
    - El archivo de base de datos se encuentra como: login.sql
    - Conéctate a tu servidor de base de datos.
    - Crea una base de datos con el mismo nombre que la base de datos a importar.
    - Importa la base de datos y selecciona el archivo: login.sql.
    - Inicia la importación.

## Creación de usuarios

1. De momento los usuarios solo se registran desde la base de datos.

2. Las contraseñas deben estar encriptadas por hash.

3. Los campos nombre, apPaterno, apMaterno, telefono e email pueden ser nulos.