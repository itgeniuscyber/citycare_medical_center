# CityCare Medical Centre - Management System

A comprehensive Clinic Appointment and Patient Management System built with **Laravel 11**, designed to solve inefficiencies in manual clinic operations. This project fulfills all requirements for the project-based exam.

## 🚀 Features

### Core Modules
*   **Role-Based Access Control (RBAC):** Distinct dashboards and permissions for Administrator, Receptionist, Doctor, Cashier, and Patient.
*   **Patient Management:** Register patients, maintain medical records, and provide patients with a self-service portal.
*   **Doctor Management:** Create doctor profiles, assign them to departments, and manage schedules.
*   **Appointment Booking:** Advanced booking system preventing double-booking, complete with status tracking (Pending, Confirmed, Completed, Cancelled).
*   **Billing & Payments:** Record and track patient payments for consultations and treatments.

### Advanced Features (Exam Part C)
*   **AJAX Dynamic Slots:** Real-time loading of available appointment slots via a JSON API endpoint (`/api/available-slots`) based on the selected doctor and date.
*   **Search & Filtering:** Dynamic search functionality across Patient and Appointment tables.
*   **Pagination:** Built-in Laravel pagination for all major entity lists.
*   **Beautiful UI/UX:** A custom, modern "Glassmorphism" theme built with **Tailwind CSS**, Alpine.js, and Chart.js.

---

## 🛠️ System Setup & Installation

Follow these steps to get the project running on your local machine using XAMPP.

### Prerequisites
*   PHP >= 8.2
*   Composer
*   Node.js & NPM
*   MySQL (via XAMPP)

### Step-by-Step Guide

1.  **Clone the repository / Extract the folder** into your XAMPP `htdocs` directory:
    ```bash
    cd /Applications/XAMPP/xamppfiles/htdocs/city_care_medical_center
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Install Node Dependencies & Build Assets:**
    ```bash
    npm install
    npm run build
    ```

4.  **Environment Setup:**
    *   Duplicate the `.env.example` file and rename it to `.env`.
    *   Update the database credentials to match your local XAMPP setup:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=citycare
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate App Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations & Seed Database:**
    This command creates all the tables and populates them with test data (Admins, Doctors, Patients).
    ```bash
    php artisan migrate:fresh --seed
    ```

7.  **Start the Local Server:**
    *(If not using XAMPP virtual hosts)*
    ```bash
    php artisan serve
    ```

---

## 🔑 Test Accounts

You can log in to the system using the following seeded accounts. **The password for all accounts is `password`.**

| Role | Email |
| :--- | :--- |
| **Administrator** | `admin@citycare.com` |
| **Receptionist** | `reception@citycare.com` |
| **Doctor** | `doctor@citycare.com` |
| **Cashier** | `cashier@citycare.com` |
| **Patient** | `patient@citycare.com` |

---

## 💻 Code Structure Highlights (Exam Part D)

*   **Controllers:** Found in `app/Http/Controllers`. Uses strict `--resource` methods for clean CRUD operations.
*   **Models:** Found in `app/Models`. Utilizes `$fillable` attributes and Eloquent Relationships (`belongsTo`, `hasMany`). All models implement `SoftDeletes`.
*   **Views:** Found in `resources/views`. Organized cleanly into folders (`appointments`, `patients`, `dashboard`) using Blade Components and Layouts.
*   **API:** Custom endpoint logic resides in `AppointmentController@getAvailableSlots` to handle the AJAX requests securely.