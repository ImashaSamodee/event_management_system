# 🎓 Student Event Management System

A dynamic web application designed to simplify the organization and management of university student events.  
Developed using **HTML, CSS, JavaScript, PHP, and MySQL**, this system allows students to explore upcoming events, register online, and stay updated about campus activities.

🌐 **Live Demo:** [Student Event Management System](https://imashasamodee.github.io/event_management_system/)

---

## 🚀 System Overview

The **Student Event Management System** enables:
- Admins to **add, update, or delete** events.
- Students to **browse, view details, and register** for events.
- Dynamic interaction between **frontend and backend** through PHP and MySQL.
- Real-time validation and responsive layout for all devices.

---

## 🧩 Features

### 👩‍🎓 For Students:
- View all and upcoming university events (seminars, hackathons, sports, etc.)
- Register easily with name, student ID, email, and contact number.
- See event details including venue, date, and organizers.
- Receive on-screen confirmation after registration.

### 🧑‍💻 For Admin:
- Secure login to manage event listings.
- CRUD operations: Create, Read, Update, and Delete events.
- View registered participants for each event.

### ⚙️ Technical Features:
- Responsive UI using **HTML5 & CSS3**
- Client-side validation with **JavaScript**
- Server-side processing with **PHP**
- Database management with **MySQL**
- Secure database interaction using **Prepared Statements**
- Organized directory structure and modular code

---

## 🗄️ Database Structure

### Tables:
1. **users**
   - `user_id`, `name`, `email`, `password`
2. **events**
   - `event_id`, `title`, `date`, `venue`, `description`
3. **registrations**
   - `reg_id`, `user_id`, `event_id`, `timestamp`

Each table is connected by **primary and foreign keys** to maintain data integrity and relationships.

---

## 🛠️ System Setup

### 1. Requirements:
- XAMPP or WAMP server installed
- PHP ≥ 7.4
- MySQL Database

### 2. Steps to Run Locally:
1. Clone this repository:
   ```bash
   git clone https://github.com/imashasamodee/event_management_system.git

---

http://localhost/event_management_system/

---

## 🧠 Implementation Details

### 🎨 Frontend
Designed for **user-friendliness and responsiveness** using **HTML5**, **CSS3**, and **JavaScript**.  
Includes modern UI elements and responsive layouts to ensure smooth viewing on mobile, tablet, and desktop devices.

### ⚙️ Backend
Developed using **PHP**, which handles all **form submissions, event management, and CRUD (Create, Read, Update, Delete)** operations.  
Server-side scripts ensure secure interaction between users and the database.

### ✅ Validation
Implemented using **JavaScript** to ensure that all user inputs are correct before submission.  
Examples:
- Valid email format check  
- Mandatory field validation  
- Real-time feedback for form fields  

### 🗄️ Database Connectivity
Managed through **MySQL** using **PDO (PHP Data Objects)** for secure and efficient database queries.  
This approach prevents SQL injection and maintains a smooth data flow between the web interface and the backend server.
