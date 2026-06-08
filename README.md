# 🎓 Student Event Management System

> A full-stack web application built for ITUM (Institute of Technology, University of Moratuwa) that allows students to browse and register for campus events, while admins can manage events, users, and registrations through a dedicated dashboard.

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

---

## 📖 About

The **Student Event Management System** is a web-based platform designed for ITUM students and staff. Students can register for an account using their Student ID, browse upcoming and completed events, and register for events they wish to attend. Administrators have access to a full dashboard where they can manage events, users, and view all registrations.

---

## ✨ Features

### 👨‍🎓 Student Features
- 🏠 **Home Page** — Browse upcoming events with date, venue, and description
- 📋 **View Events** — Full list of events with Upcoming / Completed status
- 🔐 **Register / Login** — Account creation and login using Student ID and password
- 👤 **Profile Page** — View personal account details
- ✅ **Event Registration** — Register for any upcoming event

### 🛠️ Admin Features
- 📊 **Admin Dashboard** — Overview with quick-access buttons to all management panels
- 📅 **Event Management** — Add, Edit, and Delete events (ID, Title, Date, Location, Description, Status)
- 👥 **User Management** — Add, Edit, and Delete student/admin accounts with role assignment
- 📋 **Registrations** — View all event registrations across all users
- 🔒 **Role-Based Access** — Admin-only sections hidden from regular students

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML5, CSS3 |
| Backend | PHP (with Sessions) |
| Database | MySQL |
| Icons | Font Awesome 6.5 / 7.0 (CDN) |
| Local Server | XAMPP (Apache + MySQL) |

---

## 🗄️ Database Schema

**Database name:** `23it0527_event_management`

| Table | Key Columns |
|-------|-------------|
| `users` | `student_id`, `full_name`, `email`, `contact_no`, `password`, `role` |
| `events` | `event_id`, `title`, `date`, `location`, `description`, `status` |
| `registrations` | `student_id`, `event_id`, `registered_at` |

---

## 📁 Project Structure

```
event_management_system/
│
├── index.html              # Home page — upcoming events
├── event.html              # All events listing page
├── login.html              # Login page
├── register.html           # Student registration page
├── contact.html            # Contact Us page
├── style.css               # Main frontend stylesheet
│
├── api/                    # PHP backend files
│   ├── connection.php      # MySQL database connection
│   ├── login.php           # Session-based login logic
│   ├── register.php        # Student registration logic
│   ├── logout.php          # Session destroy & logout
│   ├── dashboard.php       # Role-based dashboard (student/admin)
│   ├── event.php           # Event listing for logged-in users
│   ├── event_management.php  # Admin: Add / Edit / Delete events
│   ├── user_management.php   # Admin: Add / Edit / Delete users
│   ├── registrations.php     # Admin: View all registrations
│   ├── profile.php           # User profile page
│   └── dashboard_style.css   # Dashboard-specific styles
│
├── database/
│   └── 23it0527_event_management.sql   # MySQL database dump
│
└── images/
    ├── logo.png
    ├── background.jpg
    └── Events/
        ├── Event1.png ... Event8.png
```

---

## 🚀 Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL)
- A web browser

### Installation Steps

1. **Clone or download the repository**
   ```bash
   git clone https://github.com/ImashaSamodee/event_management_system.git
   ```

2. **Move the project to XAMPP's htdocs folder**
   ```
   C:/xampp/htdocs/event_management_system
   ```

3. **Import the database**
   - Start XAMPP and turn on **Apache** and **MySQL**
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Create a new database named `23it0527_event_management`
   - Click **Import** → choose `database/23it0527_event_management.sql` → click **Go**

4. **Configure the database connection** *(if needed)*

   Open `api/connection.php` and update:
   ```php
   $host = "localhost";
   $user = "root";
   $pass = "";        // your MySQL password
   $db   = "23it0527_event_management";
   ```

5. **Run the project**

   Open your browser and go to:
   ```
   http://localhost/event_management_system
   ```

---

## 🔑 Default Login Credentials

| Role | Student ID | Password |
|------|-----------|----------|
| Admin | `23IT0527` | `Imasha@123` |
| Student | `23IT0470` | `123456` |

---

## 🧭 Pages & Navigation

| Page | URL | Access |
|------|-----|--------|
| Home | `index.html` | Public |
| View Events | `event.html` | Public |
| Login | `login.html` | Public |
| Register | `register.html` | Public |
| Contact | `contact.html` | Public |
| Dashboard | `api/dashboard.php` | Logged-in users |
| Events (dashboard) | `api/event.php` | Logged-in users |
| Profile | `api/profile.php` | Logged-in users |
| Event Management | `api/event_management.php` | Admin only |
| User Management | `api/user_management.php` | Admin only |
| Registrations | `api/registrations.php` | Admin only |

---

## 👩‍💻 Author

**J.B.A. Imasha Samodee**
- Student ID: 23IT0527
- GitHub: [@ImashaSamodee](https://github.com/ImashaSamodee)
- Email: imashasamodee@gmail.com

---

## 📄 License

Copyright © 2025 ITUM Events. All Rights Reserved.

---

<p align="center">Made with ❤️ for ITUM Students</p>
