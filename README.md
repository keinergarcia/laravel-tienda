# Laravel Tienda

<div align="center">
  <img src="https://laravel.com/img/logomark.max.svg" alt="Laravel Logo" width="150" />
</div>

<p align="center">
  <b>E-commerce desarrollado con Laravel 12</b><br>
  como proyecto académico del SENA.
</p>

[![GitHub branch](https://img.shields.io/github/v/release/keinergarcia/laravel-tienda)](https://github.com/keinergarcia/laravel-tienda/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/framework)
[![Latest Stable](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/framework)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

---

## Acerca de este proyecto

Proyecto desarrollado en **agosto de 2024** durante los primeros semestres del programa de **Tecnólogo en Análisis y Desarrollo de Software** en el **SENA**. Representa un proyecto de aprendizaje práctico que aplica fundamentos de desarrollo web con Laravel: enrutamiento, controladores, modelos, vistas Blade, autenticación, sesiones, validación y un panel de administración básico.

---

## Funcionalidades

### 🛒 Tienda Pública
- Catálogo de productos con búsqueda
- Filtrado por categorías
- Productos destacados y populares
- Carrito de compras (sesión)
- Proceso de checkout con formulario de datos y resumen de pedido
- Historial de pedidos y confirmaciones
- Perfil de usuario con estadísticas de compra

### 🔐 Autenticación
- Registro de usuarios con validación de contraseña mínima de 8 caracteres
- Inicio de sesión con rate limiting
- Gestión de sesiones
- Cierre de sesión seguro

### 🛡️ Panel de Administración
- Dashboard con estadísticas en tiempo real (productos, categorías, usuarios, pedidos)
- Control CRUD completo de productos con búsqueda
- Gestión de categorías con validación de relaciones
- Administración de usuarios con control de roles (admin/cliente)
- Protección de rutas admin con middleware personalizado `is_admin`

---

## Tecnologías

[![PHP](https://img.shields.io/badge/PHP-8.2-blue)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12-red)](https://laravel.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)](https://getbootstrap.com)
[![Font Awesome](https://img.shields.io/badge/Font%20Awesome-6.5-orange)](https://fontawesome.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)](https://mysql.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v3.4-green)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-5-yellow)](https://vitejs.dev)

- **PHP 8.2**
- **Laravel 12**
- **Bootstrap 5.3**
- **MySQL**
- **Vite** (bundler de assets)
- **Tailwind CSS** (a través de Laravel Breeze)
- **Font Awesome 6.5** (íconos)

---

## Estructura del Proyecto

```
laravel-tienda/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php      # Dashboard del admin
│   │   │   ├── CartController.php        # Lógica del carrito
│   │   │   ├── CategoryController.php    # CRUD categorías
│   │   │   ├── OrderController.php       # Procesamiento de pedidos
│   │   │   ├── ProductController.php     # Productos (público + admin)
│   │   │   └── UserController.php        # Auth, registro, perfil, usuarios admin
│   │   ├── Kernel.php                    # Kernel HTTP
│   │   └── Middleware/
│   │       └── IsAdmin.php              # Middleware de acceso admin
│   └── Models/
│       ├── Category.php
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Product.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── index.php
├── resources/
│   ├── css/
│   │   ├── app.css
│   │   └── custom.css                   # Estilos personalizados neon
│   ├── js/
│   └── views/
│       ├── auth/                        # Login / Registro
│       ├── cart/                        # Vista del carrito
│       ├── orders/                      # Checkout, historial, confirmación
│       ├── products/                    # Catalogo público + formularios
│       ├── admin/                       # Panel de administración
│       │   ├── dashboard/
│       │   ├── categories/
│       │   ├── products/
│       │   └── users/
│       └── layouts/
│           ├── app.blade.php
│           ├── admin/
│           │   └── app.blade.php        # Layout con sidebar para admin
│           ├── header.blade.php
│           └── footer.blade.php
├── routes/
│   └── web.php                          # Todas las rutas de la aplicación
└── bootstrap/
    └── app.php
```

---

## Instalación

### Requisitos previos
- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js y npm (para assets)

### Pasos

1. **Clonar el repositorio**
```bash
git clone https://github.com/keinergarcia/laravel-tienda.git
cd laravel-tienda
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Instalar dependencias de Node**
```bash
npm install
```

4. **Configurar variables de entorno**
```bash
cp .env.example .env
```
Editar el archivo `.env` y configurar los datos de conexión a la base de datos MySQL:
```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_tienda
DB_USERNAME=root
DB_PASSWORD=
```

5. **Generar clave de aplicación**
```bash
php artisan key:generate
```

6. **Ejecutar migraciones y seeders**
```bash
php artisan migrate --seed
```

7. **Compilar assets**
```bash
npm run build
```

8. **Iniciar el servidor de desarrollo**
```bash
php artisan serve
```

La aplicación estará disponible en `http://127.0.0.1:8000`.

> **Nota:** Para acceder al panel de administración, inicia sesión con una cuenta cuyo campo `role` sea `admin`.

---

## Rutas principales

| Ruta | Nombre | Descripción |
|------|--------|-------------|
| `/` | `home` | Catálogo principal de productos |
| `/login` | `login` | Iniciar sesión |
| `/register` | `register` | Crear cuenta |
| `/perfil` | `profile` | Perfil de usuario |
| `/pedidos` | `orders.history` | Historial de pedidos |
| `/checkout` | `checkout.form` | Proceso de pago |
| `/admin` | `admin.dashboard` | Panel de administración |
| `/admin/productos` | `admin.products` | Gestión de productos |
| `/admin/categorias` | `admin.categories` | Gestión de categorías |
| `/admin/usuarios` | `admin.users.index` | Gestión de usuarios |

---

## Características del diseño

- **Temática oscura neón** con acentos cyan y gradientes de color
- **Layout responsive** adaptado a escritorio y móvil
- **Panel de administración** con sidebar fija y navegación intuitiva
- **Alertas flash** para feedback de acciones (éxito/error)
- **Validación de formularios** con mensajes de error contextuales
- **Badge de destacado** en productos y estatus de pedidos en tiempo real

---

## Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE).

---

## Autor

**Keiner García Ortiz**
- Desarrollo del proyecto completo como parte del programa de **Tecnólogo en Análisis y Desarrollo de Software** del SENA.
- Desarrollo realizado en **agosto de 2024**.

---

## Agradecimientos

- [Laravel](https://laravel.com) — framework que hizo posible este proyecto.
- [Bootstrap](https://getbootstrap.com) — sistema de diseño.
- [Font Awesome](https://fontawesome.com) — íconos.
- [SENA](https://www.senasofiaplus.edu.co/) — institución de formación.