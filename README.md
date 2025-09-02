# 📊 Smart Factory Dashboard

A simple and clean web-based dashboard to monitor factory performance in real-time.
This project is designed for learning purposes and as a portfolio demo to showcase building a factory management system with modern web technologies.

## 🚀 Features
- 👩‍💼 Employees Management – manage and track factory employees
- 📦 Inventories Management – monitor and update inventories
- 🛠️ Productions Management – track ongoing, pending, and completed productions
- 📊 Analytics & Visualization – monthly production charts, trends, and product distribution
- 📝 Recent Activity – keep track of latest updates and production status

## 🖼️ Preview
<img width="2560" height="2670" alt="image" src="https://github.com/user-attachments/assets/e7c64f32-8e26-473f-83d2-d348dbafb033" />

## 🛠️ Tech Stack
- Backend: Laravel (PHP)
- Frontend: Blade Template + Bootstrap
- Database: sqlite
- Charts: Chart.js

## 📂 Installation

Clone the repository:
```
git clone https://github.com/your-username/smart-factory.git
cd smart-factory-dashboard
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

Run migrations:
```
php artisan migrate
```

Start the development server:
```
php artisan serve
```

## 📊 Example Data
Employees: 2
Inventories: 2
Productions: 3 (with different statuses: Done, In Progress, Pending)
