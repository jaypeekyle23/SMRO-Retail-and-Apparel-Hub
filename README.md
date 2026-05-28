# Thread — Retail & Apparel Hub

Thread is a full-featured Retail & Apparel Hub management system built with CodeIgniter 4. It serves as a central hub for inventory control, sales management, supplier coordination, and self-service customer shopping — with a secure RESTful API for external integrations.

---

## Tech Stack

- **Framework:** CodeIgniter 4.6.1
- **Language:** PHP 8.2
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Chart.js, Feather Icons
- **Testing:** PHPUnit 10

---

## Roles

Thread supports four access levels, each with a tailored interface:

| Role       | Description                                                                 |
|------------|-----------------------------------------------------------------------------|
| Superadmin | Full access to all modules including system settings and menu management     |
| Manager    | Access to catalog, sales, customers, suppliers, and purchase orders          |
| Staff      | Access to products, inventory, POS, sales history, customers, and returns    |
| User       | Self-service customer portal: shop, cart, checkout, orders, and returns      |

---

## Features

### Staff & Admin Modules
- **Authentication** — Login, logout, registration with password hashing. Self-registered accounts are automatically assigned the User role.
- **Authorization** — Role-Based Access Control (RBAC) with dynamic menu-level permission management
- **Dashboard** — Live stats, low stock alerts, recent activity feed, daily revenue chart, top-selling products chart
- **Products** — Full CRUD with multi-variant support (size/color), image upload, and stock tracking
- **Inventory / Stock Ledger** — Stock movement logs (IN/OUT), manual adjustments, search, pagination, CSV export
- **Point of Sale (POS)** — Staff-facing cart system, customer capture, checkout, automatic stock deduction
- **Sales History** — Order listing with date filter, search, pagination, CSV export, and printable receipts
- **Customers** — Auto-created on POS checkout or self-registration, order history, total spent
- **Suppliers** — Full supplier management (CRUD)
- **Purchase Orders** — Create POs from suppliers; receiving a PO automatically updates inventory
- **Returns & Refunds** — Log return requests, approve or reject them with status tracking
- **Menu Management** — Dynamic menu system with per-role access control per menu item
- **User Management** — Create, update, and delete users and role assignments
- **Settings** — Role access management

### User (Customer) Portal
- **Shop** — Browse all active products with images, sizes, colors, stock availability, and search
- **Cart** — Add items to cart with variant selection, update quantities, switch variants, and remove items
- **Checkout** — Review cart, adjust items, and place orders with a single click
- **Order Confirmed** — Printable receipt page after every successful order (PDF-saveable)
- **My Orders** — Full order history with itemized receipts and return/refund request per order
- **Return & Refund Requests** — Submit return requests per order item with quantity and reason; receive approval or rejection notifications on both the dashboard and orders page
- **User Dashboard** — Personalized dashboard showing total orders, total spent, approved return count, pending/approved/rejected return updates, and recent order history

### Technical Highlights
- RESTful API with Bearer Token authentication (`/api/products`, `/api/inventory`, `/api/sales`)
- CSRF protection and XSS filtering via `esc()` throughout
- Pagination on Products, Inventory, Sales, Customers, Suppliers, and Purchase Orders
- CSV Export for Sales and Inventory reports
- Response caching on all API endpoints (`cachePage`)
- CI4 Query Builder used throughout — no raw SQL
- Database Migrations and Seeders for reproducible environments
- 10 PHPUnit unit tests covering core model logic and business rules

---

## Installation

```bash
git clone https://github.com/jaypeekyle23/SMRO-Retail-and-Apparel-Hub.git
cd SMRO-Retail-and-Apparel-Hub
composer install
```

---

## Setup

1. Copy the `.env` file and configure your database:
```bash
cp env .env
```

2. Update `.env` with your database credentials:
database.default.hostname = localhost
database.default.database = thread
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi

3. Run migrations to create all tables:
```bash
php spark migrate
```

4. Seed the database with default data:
```bash
php spark db:seed MainSeeder
```

5. Generate encryption key:
```bash
php spark key:generate
```

6. Start the development server:
```bash
php spark serve
```

---

## Default Login Credentials

| Role       | Email               | Password   |
|------------|---------------------|------------|
| Superadmin | admin@thread.com    | admin123   |
| Manager    | manager@thread.com  | manager123 |
| Staff      | staff@thread.com    | staff123   |
| User       | Register via `/register` | — |

---

## API Usage

The API requires a Bearer Token in the `Authorization` header. The default token is seeded automatically and can be found in the `api_tokens` table.

### Endpoints

| Method | Endpoint            | Description                  |
|--------|---------------------|------------------------------|
| GET    | /api/products       | Get all active products       |
| GET    | /api/products/{id}  | Get a specific product        |
| GET    | /api/inventory      | Get stock movement logs       |
| GET    | /api/sales          | Get sales orders              |

### Example Request

```bash
curl -X GET http://your-domain.com/api/products \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

## Running Tests

```bash
vendor/bin/phpunit tests/unit/ThreadTest.php
```

---

## Server Requirements

- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer
- Extensions: `curl`, `fileinfo`, `gd`, `intl`, `mbstring`, `mysqlnd`, `openssl`, `json`, `xml`

---