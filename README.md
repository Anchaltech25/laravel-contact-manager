# Laravel Contact Manager

A backend-focused Contact Management System built using Laravel.  
This project demonstrates strong backend development skills including authentication, authorization, CRUD operations, queues, and database relationships.

---
## Architecture Highlights

- Implemented **Event-Driven Architecture** using Laravel Events & Listeners
- Used **Queue System** for background processing (asynchronous tasks)
- Designed **Role-Based Access Control (RBAC)** for secure user permissions
- Built **optimized query filtering system** for scalable data handling
- Implemented **AJAX-based UI updates** for real-time interaction without page reloads
- Structured relational database (User → Contacts) following best practices

##  Features

- User Authentication (Login / Register)
- Role-Based Authorization
- Contact Management (CRUD)
- Search & Filters (name, email, status, date range)
- Pagination for large datasets

###  Advanced / UX Features
- Profile Image Upload for Users & Contacts
- Fallback Avatar with Initials & Dynamic Colors
- User Profile Page with Associated Contacts (One-to-Many Relationship)
- Toggle Contact Status (Active/Inactive via AJAX)
- Clean UI with Card-based Layout

###  Backend Features
- Eloquent ORM Relationships (User ↔ Contacts)
- Jobs & Queues for background processing
- Form Validation & Error Handling


---

## 🛠 Tech Stack

- PHP (Laravel)
- MySQL
- Blade (Basic UI)
- Bootstrap (Minimal Styling)
- Laravel Queue System

---

##  Screenshots

### Contact List  (before loggedin)
<img width="1288" height="820" alt="contactManager-home" src="https://github.com/user-attachments/assets/8f9be7cd-ab20-4366-8981-e8b7743dc509" />

## after login)
<img width="1284" height="828" alt="contactManager-loggedin-Home" src="https://github.com/user-attachments/assets/53906728-6039-4158-bef9-14ae310e9f55" />

## Add Contact
<img width="1277" height="818" alt="contactManger-create" src="https://github.com/user-attachments/assets/e0f0eaf7-12f9-49b2-9be6-6aa6839dd77d" />


## Login Page
<img width="1309" height="821" alt="Screenshot (25)" src="https://github.com/user-attachments/assets/af30d5e2-aecc-4d83-9702-66512b49bc30" />

## edit page 
<img width="1276" height="834" alt="contectManger-edit" src="https://github.com/user-attachments/assets/96f5a856-99bd-4693-a31a-0ef99cf63d1c" />


## view page
<img width="1275" height="642" alt="contactManager-view" src="https://github.com/user-attachments/assets/aca0a9db-cdaa-48ee-a013-f98ac8218b5f" />

## user profile view with deafult image and users image 

<img width="1299" height="509" alt="Screenshot (28)" src="https://github.com/user-attachments/assets/dcc003df-d715-4985-a5b3-c676ed0dbe0c" />

<img width="1286" height="784" alt="Screenshot (32)" src="https://github.com/user-attachments/assets/57a85464-a897-45e0-9857-fa2150b89482" />

---

##  Installation

```bash
git clone https://github.com/Anchaltech25/laravel-contact-manager
cd laravel-contact-manager
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
