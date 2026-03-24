# Prueba Técnica - Gestión de Documentos KAWAK

Este proyecto es una aplicación CRUD completa para el registro de documentos, construida con PHP puro, siguiendo una arquitectura MVC y utilizando Eloquent ORM para la capa de datos.

## Requisitos
- PHP 7.2.22+ (Configurado para compatibilidad).
- MySQL 5.7+
- Composer

## Instalación

1.  Clonar el repositorio.
2.  Ejecutar `composer install` para instalar las dependencias (`illuminate/database`, `vlucas/phpdotenv`).
3.  Configurar la base de datos:
    -   Crear la base de datos `prueba_tecnica_jorge`.
    -   Ejecutar los scripts SQL ubicados en `scripts/ddl.sql` y `scripts/dml.sql`.
4.  Configurar el archivo `.env` con las credenciales de tu base de datos.
5.  Configurar el servidor web para que apunte a la carpeta `public/` o utilizar un servidor local (ej: `php -S localhost:8000 -t public`).

## Acceso al Sistema
- **URL:** `/login`
- **Usuario:** `admin`
- **Contraseña:** `kawak2024`

## Estructura del Proyecto
- `app/`: Contiene el núcleo de la aplicación (MVC).
  - `Controllers/`: Lógica de negocio y control.
  - `Models/`: Modelos de Eloquent.
  - `Views/`: Plantillas de vista PHP.
  - `Core/`: Clases base (Database, Router, Controller, Session).
  - `Helpers/`: Clases de apoyo (CodeGenerator).
- `public/`: Directorio público y punto de entrada (`index.php`).
- `config/`: Archivos de configuración.
- `scripts/`: Scripts SQL de base de datos.

## Autores
- Jorge Alejandro - Prueba Técnica para KAWAK.
