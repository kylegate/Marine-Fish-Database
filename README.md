# Marine Fish Database 🐠  

A dynamic web-based system for managing aquarium-related data, developed using **PHP**, **MySQL**, and **Apache Server**. This project demonstrates the integration of relational database principles into a full-stack application, featuring secure data management, real-time interactions, and advanced database functionalities.

---

## Features  
- **Dynamic Entity-Relationship (ER) Model:**  
  Ensures data integrity by defining entities, relationships, and attributes in a normalized database structure.  

- **Role-Based Access Control (RBAC):**  
  Secures the application by restricting access to authorized users (e.g., Admin, User).  

- **Secure Data Management:**  
  - Real-time data interactions.  
  - SQL injection prevention.  
  - Secure form validation (client-side and server-side).  

- **Advanced Database Features:**  
  - ACID compliance for transactional integrity.  
  - Implementation of stored procedures and triggers to automate database operations.  

---

## Tech Stack  
- **Frontend:** HTML, CSS  
- **Backend:** PHP  
- **Database:** MySQL  
- **Server:** Apache  
- **Other Libraries/Tools:**  
  - MySQLi (Database connection and queries)  
  - XAMPP for local server setup  

---

## Installation & Setup  

1. **Pre-requisites:**  
   - Install [XAMPP](https://www.apachefriends.org/index.html) (or any local server environment with Apache and MySQL).  

2. **Clone the Repository:**  
   git clone https://github.com/YourUsername/.git

3. **Move Files to htdocs:**
   C:/xampp/htdocs/Marine-Fish-Database
   
4. **Start Apache and MySQL Servers:**
Open the XAMPP control panel and start the Apache and MySQL services.

5. **Import the Database:**
  Open phpMyAdmin in your browser.
  Create a new database (e.g., aquarium_db).
  Import the SQL file included in the database folder of the repository.

6. **Access the Application:**
  Open your browser and navigate to:
  http://localhost/Marine-Fish-Database
