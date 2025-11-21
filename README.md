# 🛍️ Laravel E-Commerce System

A modern and fully functional Laravel-based e-commerce system featuring:

* Admin Dashboard
* Product & Category Management
* User Authentication & Email Verification
* CRUD Operations
* Soft Deletes
* Bootstrap UI
* Real-time validation and datatable filtering
* Seeder-based sample data

---

## 🚀 Features

### 🔐 Authentication

* User Registration & Login
* Email Verification
* Password Reset
* Role-based access (`admin`, `user`)

### 🧑‍💼 Admin Panel Includes

* Dashboard
* Category Management
* Product Management
* User Management
* Order Overview
* Profile Update
* Change Password
* Soft Deletes

### 📦 Product Features

* Category Mapping
* Multiple Attributes:
  Title, Price, Description, Quantity
* Automatic default placeholder image if missing
* Paginated list

### 🗂 Category Features

* Name, Description, Image
* List, View, Edit, Delete
* Related products check before deletion

---

## 🛠️ Tech Stack

| Component      | Technology                    |
| -------------- | ----------------------------- |
| Backend        | Laravel                       |
| Frontend       | Bootstrap 5                   |
| Database       | MySQL                         |
| Language       | PHP 8+                        |
| ORM            | Eloquent                      |
| Authentication | Laravel Built-In Auth         |
| Optional       | jQuery Validation, Datatables |

---

## 📁 Project Structure

```
app/
├── Models/
│   ├── Category.php
│   ├── Product.php
│   └── User.php
├── Http/
│   └── Controllers/
routes/
│   └── web.php
resources/
│   └── views/
public/
└── (assets)
```

---

## ⚙️ Installation

### 1️⃣ Clone

```bash
git clone https://your-repository-url.git
cd project-folder
```

### 2️⃣ Install dependencies

```bash
composer install
npm install && npm run build
```

### 3️⃣ Setup `.env`

```bash
cp .env.example .env
```

Edit database credentials:

```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Generate key

```bash
php artisan key:generate
```

### 5️⃣ Run migrations

```bash
php artisan migrate
```

### 6️⃣ (Optional) Seed sample data

```bash
php artisan db:seed
```

### 7️⃣ Start server

```bash
php artisan serve
```

---

## 🔑 Default Test Login

| Role  | Email                                         | Password |
| ----- | --------------------------------------------- | -------- |
| Admin | [admin@example.com](mailto:admin@example.com) | password |
| User  | [user@example.com](mailto:user@example.com)   | password |

---

## 💽 Seeder Data

Seeder generates:

* **10+ Sample Categories**
* **50+ Sample Products**
* **Admin user**
* **Normal user**

---

## 🧪 Testing

```bash
php artisan test
```

---

## 🐛 Reporting Issues

If you face bugs:

* Create GitHub issue
* Include steps, screenshots, and expected output

---

## 🤝 Contributing

Pull requests are welcome.
Follow:

* PSR-12 Coding Standard
* Laravel conventions

---

## 📄 License

This project is open-source and free to use.

---

## ⭐ Credits

Developed with Laravel ❤️
Your Name
