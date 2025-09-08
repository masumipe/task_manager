# Task Monitor PHP MVC

## Features

- MVC structure (Controllers, Models, Views)
- Responsive design (Bootstrap 5, mobile-first)
- Authentication (login/logout, session timeout)
- MySQL database connection

## Setup

1. Import the provided MySQL schema (see below).
2. Update `config/config.php` with your database credentials.
3. Place the project in your web server root (e.g., `htdocs`).
4. Access via browser: `http://localhost/task_monitor/public`

## Database Schema Example

```sql
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);
```

## Default Routes

- `/login` — Login page
- `/logout` — Logout
- `/` — Dashboard (requires login)

## Next Steps

- Implement user registration, permissions, and menu system
- Add CRUD for tasks and task assignment
- Add notification and productivity features
