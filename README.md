# PHP Mini E‑Commerce

A lightweight **PHP** mini store that demonstrates core e‑commerce flows: **browse products, view details, add to cart, checkout**, and a simple **admin** interface to manage catalog data. The goal is clean, student‑friendly code that you can extend for class projects or interviews.

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Prerequisites](#prerequisites)
- [Quick Start](#quick-start)
- [Database Setup](#database-setup)
- [Environment Configuration](#environment-configuration)
- [Run the App](#run-the-app)
- [Routes (Typical)](#routes-typical)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
- [Roadmap Ideas](#roadmap-ideas)
- [Contributing](#contributing)
- [License](#license)
- [Author](#author)

---

## Features

- Product listing, search, and detail pages
- Categories
- Cart (add, update quantity, remove, clear)
- Checkout flow (demo / no payment gateway by default)
- Simple admin (CRUD for products and categories)
- Server‑side form validation and basic input sanitization
- Session‑based auth for admin area

> Note: If the repository starts minimal, some items may be stubs—use the Roadmap section to grow the app.

---

## Tech Stack

- **PHP 8.1+** (works with 8.0+, but 8.1+ recommended)
- **MySQL 8 / MariaDB 10.5+**
- **Composer** for dependencies (if applicable)
- **Vanilla PHP** and **Bootstrap/Tailwind** (depending on provided assets)
- Optional: **Apache** or **Nginx**; or PHP built‑in server for local dev

---

## Project Structure

> This is a typical structure for a small PHP project. Names may differ in your repo—update as needed.

```text
php-mini-ecommerce/
├─ public/                 # Web root (index.php, CSS, JS, assets)
├─ src/                    # App logic (controllers, models, helpers)
├─ views/                  # Templates / partials
├─ config/                 # Database connection, app settings
├─ database/
│  ├─ migrations/          # SQL migration files (if any)
│  └─ seed/                # Seed data (optional)
├─ vendor/                 # Composer deps (auto after install)
├─ .env.example            # Example environment file
├─ .env                    # Your local environment file (ignored by Git)
├─ composer.json           # Composer definition (if used)
└─ README.md
```

---

## Prerequisites

- PHP 8.1+ (`php -v`)
- MySQL or MariaDB running locally
- Composer (`composer -V`) — only if the project uses it
- Git

---

## Quick Start

1. **Clone the repository**
   ```bash
   git clone https://github.com/tamimafg6/php-mini-ecommerce.git
   cd php-mini-ecommerce
   ```

2. **Install dependencies (if composer.json exists)**
   ```bash
   composer install
   ```

3. **Create a database**
   ```sql
   CREATE DATABASE shop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

4. **Configure environment** (see the next section).

5. **Load schema & seed data** (see [Database Setup](#database-setup)).

6. **Run the app** (see [Run the App](#run-the-app)).

---

## Database Setup

Choose **one** path depending on what the repo provides.

### Option A — Import SQL dump
If the repo contains `database/schema.sql` or `database/dump.sql`, import it:
```bash
# Example using MySQL CLI
mysql -u root -p shop_db < database/schema.sql
# (Optional) seed some demo data
mysql -u root -p shop_db < database/seed/seed.sql
```

### Option B — Migrations via PHP scripts
If the project ships a **migrate.php** or similar:
```bash
php database/migrate.php
php database/seed.php    # optional
```

> Don’t see either file? Create the tables from your models or export your own SQL once developed.

---

## Environment Configuration

1. **Copy the example file** and edit values:
   ```bash
   cp .env.example .env
   ```
2. **Set DB credentials** in `.env`:
   ```env
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_NAME=shop_db
   DB_USER=root
   DB_PASS=your_password

   # Optional app settings
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   SESSION_NAME=mini_shop
   ```

> If the project doesn’t use `.env`, update `config/database.php` or whatever config file it provides.

---

## Run the App

### Using PHP’s built‑in server (recommended for quick local dev)
```bash
php -S localhost:8000 -t public
```
Then open **http://localhost:8000** in your browser.

### Using Apache or Nginx
- Point your **DocumentRoot** (Apache) or **root** (Nginx) to the `public/` folder.
- Make sure `.htaccess`/rewrites are enabled if the app uses clean URLs.

---

## Routes (Typical)

Public area:
- `GET /` — Home / product listing
- `GET /product/{id}` — Product detail
- `POST /cart/add` — Add item to cart
- `POST /cart/update` — Update quantity
- `POST /cart/remove` — Remove item
- `GET /cart` — View cart
- `GET /checkout` — Checkout form
- `POST /checkout` — Place order (demo)

Admin area (examples):
- `GET /admin` — Dashboard (login required)
- `GET /admin/products` — List products
- `GET /admin/products/create` — Create product form
- `POST /admin/products` — Store product
- `GET /admin/products/{id}/edit` — Edit product
- `POST /admin/products/{id}` — Update product
- `POST /admin/products/{id}/delete` — Delete product
- `GET /admin/categories` — Manage categories

> Update paths to match your router or directory structure.

---


## Testing

If you add tests:
- **PHPUnit**: configure in `phpunit.xml` and run `./vendor/bin/phpunit`
- **Static analysis** (optional): `phpstan`, `psalm`

---

## Troubleshooting

- **White page / blank screen** → Enable `APP_DEBUG=true` or check `error_reporting` in `php.ini`.
- **DB connection fails** → Verify `.env` credentials and that MySQL is listening on the configured host/port.
- **404s on clean URLs** → Ensure `.htaccess`/rewrites are enabled, or use query‑string routes.
- **Sessions not persisting** → Check `session.save_path` and file permissions.

---

## Roadmap Ideas

- Real payment gateway integration (Stripe)
- Image upload & storage for products
- Pagination and filtering
- User accounts and order history
- Admin roles & permissions
- REST API endpoints for products/cart/orders
- Docker Compose for local dev (PHP, Nginx, MySQL)

---

## Contributing

1. Fork this repo  
2. Create a feature branch: `git checkout -b feature/your-change`  
3. Commit: `git commit -m "feat: add X"`  
4. Push: `git push origin feature/your-change`  
5. Open a Pull Request

---

## License

Add a `LICENSE` file (MIT/Apache-2.0/etc.) if you plan to share or reuse this code publicly.

---

## Author

**Tamim Afghanyar** — 2025
