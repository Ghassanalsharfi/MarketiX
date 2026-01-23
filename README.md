# 🏬 MarketiX – Multi-Store Marketplace System

MarketiX is a multi-store marketplace web application built using PHP and MySQL.
The system allows multiple sellers to manage their own stores and products, while providing a centralized admin panel for full marketplace control.

This project is designed to demonstrate scalable system architecture, role-based access control, and clean separation between application layers.

---

## 🚀 Features

### 🛍️ Customer
- Browse stores and products
- View product details
- Shopping cart system
- Checkout process
- Order history

---

### 🧑‍💼 Admin
- Manage sellers and stores
- Approve / block stores
- Manage products and users
- View and manage orders
- Marketplace dashboard

---

### 🧑‍💻 Seller
- Seller dashboard
- Manage store profile
- Add / edit products
- Manage orders
- Store status control

---

## 🧱 System Architecture

- Object-Oriented PHP
- Layered application structure
- Controllers for handling requests
- Models for data representation
- Middleware for access control (Admin / Seller / User)
- Centralized configuration and helpers

---

## 🗂️ Project Structure
app/
├── controllers/
├── models/
├── middleware/
├── helpers/
├── config/

public/
├── api/
├── uploads/
├── css/

views/
├── admin/
├── seller/
├── cart/
├── checkout/
├── store/
├── layouts/

database/
└── marketix_db.sql



---

## 🛠️ Technologies Used
- PHP (OOP)
- MySQL
- HTML
- CSS
- JavaScript
- PDO
- Apache (XAMPP)

---

## ⚡ How to Run the Project

1. Install **XAMPP**
2. Copy the project folder into:

3. Start **Apache** and **MySQL**
4. Import the database file:
5. Create database configuration file:
6. Open the project in your browser:


---

## 🔐 Roles & Access Control
- Admin: Full system control
- Seller: Store and product management
- User: Shopping and ordering

Access is protected using middleware.

---

## 📝 Notes
- Product and store images are included for demo purposes
- Sensitive configuration files are excluded from version control

---

## 👤 Author

**Ghassan Alsharafi**  
PHP Web Developer

## ⚙️ Database Configuration

The database configuration file is intentionally included in the project structure:

