# 🍽️ Flavorium – Order & Product Management Web App

Flavorium is a Laravel-based web application designed to manage product inventories, customer orders, and role-based user access. It supports both administrative functionality and a simple client-facing interface, making it ideal for small business product and sales management.

---

## 🌟 Features

### 🔐 Role-Based Access

- **Admin**
  - Add/edit/delete products and categories
  - Manage user accounts
  - View all orders
  - Add commands (orders)
  - Track their own total revenue and profit

- **Utilisateur (User)**
  - Place orders
  - View their own orders
  - Add products
  - Track their own total revenue and profit

### 🌐 Public Interface

Available pages for general visitors:

- 🏠 Home  
- ℹ️ About  
- 🛍️ Products  
- 📞 Contact  

---

## 🛠️ Tech Stack

- PHP 8.3
- Laravel 11
- MySQL
- Blade 
- TailwindCss

---

## 🚀 Getting Started

### 📦 Installation

```bash
# Clone the repository
git clone https://github.com/mouana/Flavorium.git

# Navigate into the project
cd Flavorium

# Install PHP dependencies
composer install

# Copy the environment file and configure your database
cp .env.example .env

# Generate application key
php artisan key:generate

# Set up your database connection in .env

# Run migrations
php artisan migrate

# (Optional) Seed database if needed
php artisan db:seed

# Serve the application
php artisan serve
