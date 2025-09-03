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

#### Dashboard
<img width="500" height="1000" alt="image" src="https://github.com/user-attachments/assets/e2f3f3b8-3f3f-40cf-8442-889b4eca4fe0" />

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

Run migrations:
```
php artisan migrate
```

Start the development server:
```
php artisan serve
```

## 📊 Example Data

- Employees
- Inventories
- Productions (with different statuses: To Do, Done, In Progress, Pending)
