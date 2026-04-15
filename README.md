# Laravel Contact Manager

A backend-focused Contact Management System built using Laravel.  
This project demonstrates strong backend development skills including authentication, authorization, CRUD operations, queues, and database relationships.

---

## 🚀 Features

- User Authentication (Login / Register)
- Role-Based Authorization
- Contact Management (CRUD)
- Search & Filters (name, email, status, date range)
- Pagination for large datasets
- Eloquent ORM Relationships
- Jobs & Queues for background processing

---

## 🛠 Tech Stack

- PHP (Laravel)
- MySQL
- Blade (Basic UI)
- Bootstrap (Minimal Styling)
- Laravel Queue System

---

## 📸 Screenshots

### Contact List  (before loggedin)
<img width="1288" height="820" alt="contactManager-home" src="https://github.com/user-attachments/assets/8f9be7cd-ab20-4366-8981-e8b7743dc509" />

## after login)
<img width="1284" height="828" alt="contactManager-loggedin-Home" src="https://github.com/user-attachments/assets/53906728-6039-4158-bef9-14ae310e9f55" />

### Add Contact
<img width="1277" height="818" alt="contactManger-create" src="https://github.com/user-attachments/assets/e0f0eaf7-12f9-49b2-9be6-6aa6839dd77d" />


### Login Page
<img width="1321" height="427" alt="Screenshot (22)" src="https://github.com/user-attachments/assets/6d9926ab-f8f3-44b6-b21b-ae37b7d17837" />

## edit page 
<img width="1321" height="427" alt="Screenshot (22)" src="https://github.com/user-attachments/assets/7e657591-b0c7-4705-826e-eddeaba85153" />

## view page
<img width="1275" height="642" alt="contactManager-view" src="https://github.com/user-attachments/assets/aca0a9db-cdaa-48ee-a013-f98ac8218b5f" />


---

## ⚙️ Installation

```bash
git clone https://github.com/Anchaltech25/laravel-contact-manager
cd laravel-contact-manager
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
