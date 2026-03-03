# Sistema de Gestión de Acceso e Institucional

Proyecto desarrollado para la materia de Desarrollo Web. Incluye una interfaz responsiva y una base de datos MariaDB gestionada mediante Docker.

## Estructura del Proyecto
- `index.html`: Pantalla de Login responsiva.
- `registro.html`: Formulario de registro con Grid de Bootstrap.
- `dashboard.html`: Bitácora de accesos con tabla dinámica.
- `database.sql`: Script de creación y datos de prueba.
- `docker-compose.yml`: Configuración del entorno de base de datos.

## Configuración del Entorno (Docker)
Para evitar conflictos con instalaciones locales (XAMPP), este proyecto utiliza el puerto **3310**.

### Pasos para ejecutar:
1. Abrir la carpeta en Visual Studio Code.
2. Ejecutar el siguiente comando en la terminal:
   ```bash
   docker-compose up -d