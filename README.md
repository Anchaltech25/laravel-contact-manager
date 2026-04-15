<img width="1321" height="427" alt="Screenshot (22)" src="https://github.com/user-attachments/assets/aa80b229-8f37-4fca-b68c-6e2c85af6238" /><img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/6deba611-2dd0-427e-a67e-b45c5e871a9a" /><img width="1288" height="820" alt="contactManager-home" src="https://github.com/user-attachments/assets/d2956735-2066-4be5-ae4d-e45d847610f0" /># Laravel Contact Manager

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
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/f985d959-08e9-4359-8ba7-f36e8b698448" />
## after login)
<img width="1284" height="828" alt="contactManager-loggedin-Home" src="https://github.com/user-attachments/assets/53906728-6039-4158-bef9-14ae310e9f55" />

### Add Contact
<img width="1277" height="818" alt="contactManger-create" src="https://github.com/user-attachments/assets/e0f0eaf7-12f9-49b2-9be6-6aa6839dd77d" />


### Login Page
<img width="1321" height="427" alt="Screenshot (22)" src="https://github.com/user-attachments/assets/6d9926ab-f8f3-44b6-b21b-ae37b7d17837" />

## edit page 
<img width="1321" height="427" alt="Screenshot (22)" src="https://github.com/user-attachments/assets/7e657591-b0c7-4705-826e-eddeaba85153" />


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
