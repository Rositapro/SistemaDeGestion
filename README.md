# Sistema de Gestión de Accesos - 6to Semestre

Este proyecto es una aplicación web funcional que gestiona el control de acceso de usuarios y registra cada intento en una bitácora auditable.

## 🛠️ Tecnologías Utilizadas
* **Docker & Docker Compose**: Para la orquestación de contenedores.
* **MariaDB**: Base de datos relacional para persistencia de usuarios y bitácora.
* **PHP 8.2**: Lógica de servidor para validación y registro de accesos.
* **Bootstrap 5**: Diseño responsivo e interfaz de usuario.

## 🚀 Instrucciones de Despliegue
Para ejecutar este proyecto en un entorno local (como el del Tec), sigue estos pasos:

1. Asegúrate de tener **Docker Desktop** iniciado.
2. Abre una terminal en la carpeta raíz del proyecto.
3. Ejecuta el comando:
   ```bash
   docker-compose up -d