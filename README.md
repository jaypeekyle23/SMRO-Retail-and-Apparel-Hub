# Thread - Retail & Apparel Hub

Thread is a full-featured Retail & Apparel Hub management system built with CodeIgniter 4. It serves as a central hub for inventory control, sales management, and supplier coordination, with a secure RESTful API for external integrations.

> **Academic Project** - Final Project for 3rd Year IT (SMRO: Secure Multi-Tenant Resource Orchestrator), Scenario Option C: Retail & Apparel Hub.

---

## Tech Stack

- **Framework:** CodeIgniter 4.6.1
- **Language:** PHP 8.2
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Chart.js, Feather Icons
- **Testing:** PHPUnit 10

---

## Features

### Core Modules
- **Authentication** — Login, logout, registration with password hashing
- **Authorization** — Role-Based Access Control (Superadmin, Manager, Staff)
- **Dashboard** — Live stats, low stock alerts, recent activity, daily revenue chart, top products chart
- **Products** — Full CRUD with multi-variant support (size/color), image upload, stock tracking
- **Inventory / Stock Ledger** — Stock movement logs (IN/OUT), manual adjustments, search, pagination, CSV export
- **Point of Sale (POS)** — Cart system, customer info capture, checkout, automatic stock deduction
- **Sales History** — Order listing with date filter, search, pagination, CSV export, printable receipt
- **Customers** — Auto-created on POS checkout, order history, total spent
- **Suppliers** — Supplier management (CRUD)
- **Purchase Orders** — Create POs from suppliers, receive stock automatically updates inventory
- **Menu Management** — Dynamic menu system with role-based access per menu item
- **User Management** — Create, update, delete users and roles
- **Settings** — Role access management

### Technical Highlights
- RESTful API with Bearer Token authentication (`/api/products`, `/api/inventory`, `/api/sales`)
- CSRF protection and XSS filtering (using `esc()`)
- Pagination on Products, Inventory, Sales, Customers, Suppliers, Purchase Orders
- CSV Export for Sales and Inventory reports
- CI4 Query Builder used throughout (no raw SQL)
- Database Migrations and Seeders
- 10 PHPUnit unit tests

---

## Installation

```bash
git clone https://github.com/jaypeekyle23/SMRO-Retail-and-Apparel-Hub.git
cd SMRO-Retail-and-Apparel-Hub
composer install
```

---

## Setup

1. Copy `.env` file and configure your database:
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

| Role       | Email                  | Password     |
|------------|------------------------|--------------|
| Superadmin | admin@thread.com       | admin123     |
| Manager    | manager@thread.com     | manager123   |
| Staff      | staff@thread.com       | staff123     |

---

## API Usage

The API requires a Bearer Token in the `Authorization` header.

### Endpoints

| Method | Endpoint          | Description              |
|--------|-------------------|--------------------------|
| GET    | /api/products     | Get all products          |
| GET    | /api/products/{id}| Get a specific product    |
| GET    | /api/inventory    | Get stock movement logs   |
| GET    | /api/sales        | Get sales orders          |

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
- Extensions: `curl`, `fileinfo`, `gd`, `intl`, `mbstring`, `mysqlnd`, `openssl`, `json`, `xml`

---
