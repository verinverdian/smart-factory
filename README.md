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
<img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/4e3ca0d6-0fe8-48bc-a8ae-fcd20b274ff1" />

#### CRUD Employees, Inventories, Productions 
<img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/4a12005f-a521-4848-9c02-a49ea32e58f2" />
<br/>
<img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/70e53290-d7e3-43ca-9bbf-918694da00ef" />
<br/>
<img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/40be35ef-4706-4c45-95cb-3fbe1e4eb1b2" />


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

- Employees: 2
- Inventories: 2
- Productions: 3 (with different statuses: Done, In Progress, Pending)
