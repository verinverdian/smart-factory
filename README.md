# 📊 Smart Factory Dashboard

A simple and clean web-based dashboard to monitor factory performance in real-time.
This project is designed for learning purposes and as a portfolio demo to showcase building a factory management system with modern web technologies.

## 🚀 Features

- 🔑 **Authentication** (Login & Logout using `employees` table)
- 👨‍💼 **CRUD Employees** – manage factory staff data
- 📦 **CRUD Inventories** – manage warehouse stock and supplies
- 🛠 **CRUD Productions** – track production items with status (`Todo`, `In Progress`, `Done`)
- 📊 **Interactive Dashboard**
  - Target vs Realization
  - Top Employee & Top Product
  - Production KPIs
  - Recent Activity
  - Monthly Production Chart
  - Production Trends
  - Production Distribution by Product
- 📤 **Export CSV** for production data
- 🔒 **Route Protection** – prevent login page access after successful login

## 🖼️ Preview

#### Dashboard
<img width="560" height="1990" alt="image" src="https://github.com/user-attachments/assets/2038a628-04f4-4f0d-b865-9656183076d5" />


## 🛠️ Tech Stack

- Backend: Laravel (PHP)
- Frontend: Blade Template + Bootstrap
- Database: sqlite
- Charts: Chart.js

## 📂 Installation

Clone the repository:
```
git clone https://github.com/your-username/smart-factory.git
cd smart-factory
```

Install dependencies:
```
composer install
npm install && npm run dev
```

Copy the environment file and configure database:
```
cp .env.example .env
php artisan key:generate
```

Run migrations & seeders:
```
php artisan migrate --seed
```

Start the development server:
```
php artisan serve
```

## 📊 Example Data

- Employees
- Inventories
- Productions (with different statuses: To Do, Done, In Progress, Pending)

## 👩‍💻 Contributor

[Verin Verdian] – Fullstack Developer
