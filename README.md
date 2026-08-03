# 🛒 ShopCart

Un **e-commerce completo** construido con **Laravel**. Incluye catálogo de productos, carrito de compras, sistema de órdenes, gestión de inventario, roles de usuario y un panel de administración con dashboard.

Este es mi proyecto más completo, y combina prácticamente todos los conceptos fundamentales del desarrollo web backend en una sola aplicación funcional.

---

## ✨ Características

### 🛍️ Para clientes
- Ver el catálogo de productos disponibles
- Agregar productos al carrito
- Ajustar cantidades (+/−) y quitar productos
- Confirmar la compra (checkout)
- Ver el historial de sus órdenes
- Contador de productos en el carrito

### 👨‍💼 Para administradores
- Panel de administración con **dashboard de estadísticas** (productos, stock, órdenes, ingresos)
- CRUD completo de productos (crear, editar, eliminar)
- Ver todas las órdenes de todos los clientes

### 🔒 Sistema
- Autenticación de usuarios (registro / login / logout)
- **Roles** (admin y cliente) con acceso restringido
- Gestión de inventario: el stock baja al comprar y se valida la disponibilidad

---

## 🛠️ Tecnologías utilizadas

- **Laravel 13** — framework de PHP
- **PHP 8.5**
- **SQLite** — base de datos
- **Blade** — motor de plantillas (con layouts reutilizables)
- **Livewire** — starter kit de autenticación
- **Eloquent ORM** — datos y relaciones

---

## 🧠 Conceptos aplicados

Este proyecto demuestra el manejo de:

- Patrón **MVC** completo
- **Relaciones Eloquent**: uno-a-muchos (usuario → órdenes) y **muchos-a-muchos** (órdenes ↔ productos vía tabla intermedia)
- **Roles y autorización** con middleware personalizado
- **Sesiones** para el carrito de compras
- **Migraciones**, **modelos** y **seeders** (datos de prueba)
- **Validación** de datos
- **Layouts de Blade** para un diseño consistente (principio DRY)
- **Eager loading** (`with`) para consultas eficientes
- **Funciones de agregación** (`count`, `sum`) para el dashboard
- Lógica de negocio: gestión de inventario, cálculo de totales

---

## 🗄️ Modelo de datos

```
users ──(uno a muchos)──> orders
                             │
                             │ (uno a muchos)
                             ▼
                        order_items <──(muchos a uno)── products
```

- Un **usuario** tiene muchas **órdenes**
- Una **orden** tiene muchos **order_items** (renglones)
- Cada **order_item** apunta a un **producto**, guardando cantidad y precio del momento de la compra
- La tabla intermedia `order_items` implementa la relación **muchos-a-muchos** entre órdenes y productos

---

## 🚀 Instalación

```bash
# 1. Clona el repositorio
git clone https://github.com/nahuelito9/shopcart.git

# 2. Entra a la carpeta
cd shopcart

# 3. Instala dependencias
composer install
npm install

# 4. Configura el entorno
cp .env.example .env
php artisan key:generate

# 5. Crea las tablas y carga datos de prueba
php artisan migrate
php artisan db:seed --class=ProductSeeder

# 6. Compila assets y enciende el servidor
npm run dev
php artisan serve
```

### Crear un usuario administrador

Regístrate desde la web y luego, con Tinker, conviértete en admin:

```bash
php artisan tinker
```

```php
$user = App\Models\User::where('email', 'tu@email.com')->first();
$user->role = 'admin';
$user->save();
```

Luego accede al panel en `/admin/products`.

---

## 📸 Capturas de pantalla

<!-- Sube tus capturas al repositorio y enlázalas aquí -->
<!-- ![Tienda](docs/tienda.png) -->
<!-- ![Dashboard admin](docs/admin.png) -->

_Próximamente_

---

## 📌 Estado del proyecto

🚧 En desarrollo — proyecto de aprendizaje en evolución. Próximas mejoras posibles:

- Categorías de productos
- Imágenes reales de productos
- Pasarela de pago simulada
- Tests automatizados del flujo de compra

---

## 👤 Autor

Desarrollado por [nahuelito9](https://github.com/nahuelito9) como parte de mi camino aprendiendo desarrollo web con Laravel.

Mi proyecto más completo hasta la fecha: un e-commerce funcional de principio a fin.