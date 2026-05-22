# 🏢 Internal Credit Stationery Store
 
**Internal Credit Stationery Store** is an internal company web platform that allows employees to order office supplies using a **virtual token (credit) system**. It solves the problem of uncontrolled stationery spending inside a company by giving each employee a monthly token budget, separating standard from premium purchases, and requiring manager approval for premium orders within each department.
 
---
 
## 🛠️ Tech Stack
 
| Layer | Technology |
|---|---|
| Backend | Laravel 12 (PHP 8.2) |
| Frontend | Blade Templates + Bootstrap 5 + Tailwind CSS v4 |
| Database | SQLite (default) / MySQL |
| Auth | Laravel UI |
| Build Tool | Vite + Sass |
 
---
 
## ✨ Features
 
### 👤 Authentication & Roles
Three distinct roles, each with their own access and permissions:
 
| Role | Access |
|---|---|
| `employee` | Browse shop, cart, place orders, view history |
| `manager` | Employee access + approve/reject premium orders for their department |
| `admin` | Full product management + view all orders across the company |
 
- Registration requires choosing a **role** and a **department**
- Each department can only have **one manager** (enforced at registration)
- Profile management: update name, email, department, password, or delete account
---
 
### 🪙 Token (Credit) System
- Every user has a **token balance** used as internal currency
- Orders deduct tokens from the user's balance at checkout
- Tokens are **reset to 1,000 every month** via a scheduled Artisan command (`app:reset-monthly-tokens`)
- If a premium order is rejected by the manager, the **tokens are refunded** automatically
---
 
### 🛍️ Shop & Cart
- Browse all available products with stock levels
- Search products by name
- View individual product details
- Add to cart, adjust quantities, remove items
- Session-based cart (no DB persistence needed)
---
 
### 📦 Orders & Checkout
Smart order splitting logic at checkout:
 
- **Standard products** → order is **automatically approved**, tokens deducted immediately
- **Premium products** → order is created with `pending` status, **waiting for manager approval**
- If a cart contains both types, **two separate orders** are created in a single DB transaction
- Stock is decremented atomically using `lockForUpdate()` to prevent race conditions
- Each order gets a unique code (`ORD-XXXXXXXX`) for tracking
---
 
### 🧑‍💼 Manager Panel
- View all **pending premium orders** from employees in their department only
- **Approve** an order → status becomes `approved`
- **Reject** an order → status becomes `rejected`, tokens are refunded, and premium product stock is restored
- Team statistics dashboard
---
 
### 🛡️ Admin Panel
- Full **product CRUD** (create, edit, update, delete) with image upload
- View all orders across the company with details
- Product types: `standard` and `premium`
---
 
### 👤 Employee Dashboard
- Overview: total orders, pending orders, recent activity
- Order history with search by order code
- Purchase history (approved orders only) with search by product name
- Profile & settings page
---
 
## 🎯 Project Goal
 
This is a **full-stack school / portfolio project** built to practice:
- Role-based access control with 3 distinct user types (employee, manager, admin)
- Internal currency / credit system with business rules
- Smart order splitting logic with DB transactions and pessimistic locking
- Department-scoped data access (managers only see their department's orders)
- Laravel console commands and scheduling
- Product management with file uploads
- Session-based cart management
---
 
