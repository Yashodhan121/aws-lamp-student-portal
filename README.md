# aws-lamp-student-portal

````markdown
# 🎓 AWS LAMP Student Portal

A cloud-based Student Management Portal built using the **LAMP stack** and deployed on **Amazon Web Services (AWS)**.

The application allows users to add and view student information through a PHP web application running on an Amazon EC2 Linux server. Student records are stored in an Amazon RDS MySQL database.

---

# 📌 Project Objective

The objective of this project is to deploy a traditional PHP-based web application on AWS using the **LAMP architecture**.

LAMP stands for:

- **L** — Linux
- **A** — Apache
- **M** — MySQL
- **P** — PHP

The project demonstrates how an EC2-hosted PHP application can connect to Amazon RDS MySQL and perform database operations.

The application provides a simple Student Management Portal where student information can be submitted through a web form and stored in a MySQL database.

---

# ☁️ AWS Services Used

| AWS Service | Purpose |
|---|---|
| Amazon EC2 | Hosts the Linux, Apache and PHP application |
| Amazon RDS | Provides the managed MySQL database |
| Amazon VPC | Provides the networking environment |
| Security Groups | Controls network access |
| IAM | Provides AWS identity and access management |
| Amazon CloudWatch | Used for monitoring and logs |

---

# 🛠️ Technologies Used

## Cloud

- Amazon Web Services (AWS)

## Compute

- Amazon EC2

## Operating System

- Ubuntu Linux

## Web Server

- Apache2

## Backend

- PHP

## Database

- MySQL 8.4.9
- Amazon RDS

## Networking

- Amazon VPC
- Internet Gateway
- Security Groups
- Subnets
- Route Tables

## Development

- HTML
- CSS
- PHP
- SQL

---

# 🏗️ Architecture

```text
                         🌐 INTERNET
                              │
                              │ HTTP :80
                              ▼
                    ┌────────────────────┐
                    │    WEB BROWSER     │
                    └─────────┬──────────┘
                              │
                              ▼
              ┌─────────────────────────────┐
              │          AWS EC2            │
              │                             │
              │       Ubuntu Linux         │
              │             │               │
              │          Apache             │
              │             │               │
              │           PHP               │
              │                             │
              │      lamp-web-server        │
              └──────────────┬──────────────┘
                             │
                             │ MySQL :3306
                             ▼
              ┌─────────────────────────────┐
              │         Amazon RDS          │
              │                             │
              │       MySQL 8.4.9           │
              │                             │
              │       lamp-mysql-db         │
              │                             │
              │        student_db           │
              │             │               │
              │          students           │
              └─────────────────────────────┘
````

---

# 🔄 Application Workflow

```text
User
 │
 │ Opens Student Portal
 ▼
Internet
 │
 │ HTTP Port 80
 ▼
EC2 Instance
 │
 │ Apache
 ▼
PHP Application
 │
 ├───────────────► index.php
 │                     │
 │                     ▼
 │                Read students
 │
 └───────────────► add_student.php
                       │
                       ▼
                  Submit Form
                       │
                       ▼
                  db.php
                       │
                       ▼
                MySQL Connection
                       │
                       ▼
                  Amazon RDS
                       │
                       ▼
                   student_db
                       │
                       ▼
                    students
                       │
                       ▼
                  Data Stored
```

---

# 🧩 Architecture Explanation

The project uses a three-layer logical architecture:

### 1. Presentation Layer

The user's web browser acts as the presentation layer.

The browser sends HTTP requests to the EC2 server.

### 2. Application Layer

The application runs on an Ubuntu Linux EC2 instance.

Apache receives the HTTP request and executes the PHP application.

The main PHP files are:

```text
index.php
add_student.php
db.php
```

### 3. Database Layer

Amazon RDS hosts the MySQL database.

The database contains:

```text
student_db
└── students
```

The PHP application communicates with RDS through MySQL port `3306`.

---

# 📁 Project Structure

```text
aws-lamp-student-portal/
│
├── README.md
│
├── index.php
│
├── add_student.php
│
├── db.php
│
└── screenshots/
    │
    ├── ec2-instance.png
    ├── security-group.png
    ├── rds-database.png
    ├── rds-connectivity.png
    ├── mysql-table.png
    ├── add-student.png
    └── student-portal.png
```

---

# 🖥️ AWS EC2 Configuration

The web server is hosted on an Amazon EC2 instance.

## EC2 Instance

```text
Instance Name: lamp-web-server
Instance ID: i-0ce25618ba1872faa
Operating System: Ubuntu Linux
Region: ap-south-1
Availability Zone: ap-south-1b
```

The EC2 instance has:

- Public IPv4 address
- Internet connectivity
- Apache web server
- PHP
- MySQL client

---

# 🌐 VPC Configuration

The EC2 instance is deployed inside the default VPC.

```text
VPC:
vpc-0072b88e7ac7eaead
```

The EC2 instance is located in:

```text
Subnet:
subnet-0231f265b0d47e36d
```

Subnet CIDR:

```text
172.31.0.0/20
```

The subnet has public IPv4 auto-assignment enabled.

The associated route table contains:

```text
172.31.0.0/16 → local
0.0.0.0/0     → Internet Gateway
```

This allows the EC2 instance to communicate with the internet.

---

# 🔐 Security Group Configuration

The EC2 Security Group controls inbound traffic to the web server.

Security Group:

```text
launch-wizard-9
```

Security Group ID:

```text
sg-028445c8c0cff3352
```

## Inbound Rules

| TypeProtocolPortSourcePurpose |     |    |                     |                              |
| ----------------------------- | --- | -- | ------------------- | ---------------------------- |
| HTTP                          | TCP | 80 | 0.0.0.0/0           | Public web access            |
| SSH                           | TCP | 22 | Administrator IP/32 | Secure server administration |

SSH access is restricted to the administrator's IP address.

Example:

```text
152.58.31.62/32
```

The administrator's public IP may change over time, so the Security Group should be updated when required.

---

# 🔒 Security Practices

Security is an important part of this project.

## SSH Security

SSH port 22 should be restricted to a trusted administrator IP.

Avoid:

```text
0.0.0.0/0
```

for SSH whenever possible.

---

## HTTP Security

Port 80 is publicly accessible because users need to access the Student Portal.

For a production deployment, HTTPS should be implemented.

---

## RDS Security

The database should not be unnecessarily exposed to the public internet.

The recommended architecture is:

```text
Internet
   │
   ▼
EC2
   │
   │ MySQL 3306
   ▼
RDS
```

The RDS Security Group should allow MySQL access only from the EC2 application's Security Group.

---

# 🔑 Credential Protection

The following information must NEVER be uploaded to GitHub:

```text
AWS Access Key
AWS Secret Access Key
AWS Session Token
SSH Private Key
.pem files
RDS Password
Database Password
API Keys
IAM Credentials
```

The real database password must remain private.

The GitHub version of `db.php` should use placeholders.

Example:

```php
<?php

$host = "YOUR_RDS_ENDPOINT";
$username = "YOUR_DATABASE_USERNAME";
$password = "YOUR_DATABASE_PASSWORD";
$database = "student_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
```

The actual credentials should be configured securely on the server and should not be committed to GitHub.

---

# 🗄️ Amazon RDS Configuration

The database is hosted using Amazon RDS for MySQL.

## RDS Instance

```text
DB Identifier:
lamp-mysql-db

Engine:
MySQL Community

Engine Version:
8.4.9

Instance Class:
db.t3.micro

Storage:
20 GiB

Region:
ap-south-1

Availability Zone:
ap-south-1b
```

The RDS instance is configured to communicate with the EC2 application.

---

# 🗃️ Database

The application uses the following database:

```text
student_db
```

The database contains the:

```text
students
```

table.

---

# 📊 Database Table

The table was created using:

```sql
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    course VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

# 📋 Database Structure

| ColumnData TypeDescription |              |                      |
| -------------------------- | ------------ | -------------------- |
| id                         | INT          | Unique student ID    |
| name                       | VARCHAR(100) | Student name         |
| email                      | VARCHAR(100) | Student email        |
| phone                      | VARCHAR(20)  | Student phone number |
| course                     | VARCHAR(100) | Student course       |
| created\_at                | TIMESTAMP    | Record creation time |

---

# 🔗 PHP and RDS Connection

The PHP application connects to Amazon RDS using MySQLi.

The connection is stored in:

```text
db.php
```

The application uses:

```php
$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);
```

If the connection fails, the application displays an appropriate database connection error.

The character set is configured as:

```php
$conn->set_charset("utf8mb4");
```

---

# 👨‍🎓 Student Management

The application provides a Student Management Portal.

## Add Student

The `add_student.php` page provides a form containing:

- Student Name
- Email
- Phone
- Course
- Add Student button

When the form is submitted:

```text
Student Form
     │
     ▼
PHP
     │
     ▼
MySQL INSERT
     │
     ▼
Amazon RDS
     │
     ▼
students table
```

The student information is stored in the RDS database.

---

# 📋 View Students

The main page:

```text
index.php
```

retrieves student records from the RDS database.

The application uses a query similar to:

```sql
SELECT id, name, email, phone, course, created_at
FROM students
ORDER BY id DESC;
```

The results are displayed in a table.

---

# 🎨 User Interface

The Student Portal provides a user-friendly interface with:

- 🎓 Student Portal header
- 📊 Student information
- ➕ Add Student button
- 📋 Student records table
- ☁️ AWS-based deployment information
- 🟢 Application/database status
- Responsive design

---

# ⚙️ EC2 Installation

## Step 1 — Update Ubuntu

```bash
sudo apt update
```

---

## Step 2 — Install Apache

```bash
sudo apt install apache2 -y
```

Start Apache:

```bash
sudo systemctl start apache2
```

Enable Apache:

```bash
sudo systemctl enable apache2
```

Check Apache:

```bash
sudo systemctl status apache2
```

---

# 🐘 Install PHP

Install PHP:

```bash
sudo apt install php libapache2-mod-php php-mysql -y
```

Verify PHP:

```bash
php -v
```

---

# 🗄️ Install MySQL Client

The MySQL client is installed on EC2 to test connectivity with Amazon RDS.

```bash
sudo apt install mysql-client -y
```

---

# 🔌 Test RDS Connection

The RDS database can be accessed from the EC2 server using:

```bash
mysql -h YOUR_RDS_ENDPOINT -P 3306 -u lampadmin -p
```

After successful authentication:

```sql
USE student_db;
```

Check the tables:

```sql
SHOW TABLES;
```

Check the structure:

```sql
DESCRIBE students;
```

Check stored student data:

```sql
SELECT * FROM students;
```

---

# 📂 Deploy PHP Files

The Apache web directory is:

```text
/var/www/html/
```

The application files are placed there:

```text
index.php
add_student.php
db.php
```

Example:

```bash
sudo nano /var/www/html/index.php
```

```bash
sudo nano /var/www/html/add_student.php
```

```bash
sudo nano /var/www/html/db.php
```

After making changes:

```bash
sudo systemctl restart apache2
```

---

# 🌐 Access the Application

After deployment, open the EC2 public IPv4 address in a browser:

```text
http://YOUR_EC2_PUBLIC_IP
```

Example format:

```text
http://13.235.76.208
```

The public IP can change if the EC2 instance is stopped and started unless an Elastic IP is configured.

---

# 🧪 Testing

The application was tested using the following process:

### Test 1 — Apache

Verify Apache:

```bash
sudo systemctl status apache2
```

Expected:

```text
active (running)
```

---

### Test 2 — PHP

Verify PHP:

```bash
php -v
```

Expected:

```text
PHP version information
```

---

### Test 3 — RDS

Connect:

```bash
mysql -h YOUR_RDS_ENDPOINT -P 3306 -u lampadmin -p
```

Expected:

```text
Welcome to the MySQL monitor.
```

---

### Test 4 — Database

```sql
USE student_db;
```

Expected:

```text
Database changed
```

---

### Test 5 — Table

```sql
SHOW TABLES;
```

Expected:

```text
students
```

---

### Test 6 — Student Data

```sql
SELECT * FROM students;
```

Expected:

```text
Student records stored in the database
```

---

### Test 7 — Web Application

Open:

```text
http://YOUR_EC2_PUBLIC_IP
```

Expected:

```text
AWS Student Portal
```

---

### Test 8 — Add Student

Enter:

```text
Student Name
Email
Phone
Course
```

Click:

```text
Add Student
```

The information should be stored in Amazon RDS.

# 🚀 Complete Deployment Process

The complete deployment process is:

```text
1. Create AWS VPC/network
        ↓
2. Launch Ubuntu EC2
        ↓
3. Configure Security Group
        ↓
4. Connect to EC2
        ↓
5. Install Apache
        ↓
6. Install PHP
        ↓
7. Install MySQL client
        ↓
8. Create Amazon RDS MySQL
        ↓
9. Configure RDS Security Group
        ↓
10. Create student_db
        ↓
11. Create students table
        ↓
12. Configure db.php
        ↓
13. Deploy PHP files
        ↓
14. Restart Apache
        ↓
15. Open EC2 Public IP
        ↓
16. Add student
        ↓
17. Verify data in RDS
```

---

# ✨ Current Features

The current application provides:

- 🎓 Student Portal
- 👨‍🎓 Add student information
- 📋 View student records
- 🗄️ MySQL database
- ☁️ Amazon RDS database hosting
- 💻 Amazon EC2 hosting
- 🐧 Ubuntu Linux
- 🌐 Apache web server
- 🐘 PHP backend
- 🔐 Security Group configuration
- 📱 Responsive user interface

---

# 🔮 Future Improvements

The application can be improved further by adding:

## 1. Edit Student

Allow administrators to modify student information.

---

## 2. Delete Student

Allow administrators to delete student records.

---

## 3. Search

Add a search function to find students by:

- Name
- Email
- Course
- Phone

---

## 4. Dashboard

Add statistics such as:

```text
Total Students
Total Courses
Recently Added Students
```

---

## 5. Authentication

Add an administrator login system.

---

## 6. HTTPS

Configure HTTPS using SSL/TLS.

---

## 7. AWS Secrets Manager

Store database credentials securely using AWS Secrets Manager instead of hard-coding credentials.

---

## 8. CloudWatch Monitoring

Add monitoring for:

- EC2 CPU utilization
- Application logs
- Apache logs
- RDS metrics

---

## 9. Automated Deployment

The application can be integrated with:

- GitHub
- AWS CodePipeline
- AWS CodeDeploy

for automated deployments.

---

# 🔐 Production Security Improvements

For a production environment, the following architecture is recommended:

```text
                     Internet
                         │
                         ▼
                  HTTPS / Port 443
                         │
                         ▼
                  Load Balancer
                         │
                         ▼
                    EC2 Server
                         │
                         │ MySQL 3306
                         ▼
                    Amazon RDS
```

Recommended security improvements:

- Use HTTPS
- Restrict SSH access
- Use IAM roles instead of long-term AWS credentials
- Use AWS Secrets Manager
- Keep RDS private where possible
- Allow RDS access only from the application Security Group
- Enable backups
- Enable monitoring
- Apply operating system updates regularly

---

# 🧠 Key Learnings

This project provided practical experience with:

### AWS

- Launching EC2 instances
- Configuring Amazon RDS
- Working with VPCs
- Configuring Security Groups
- Understanding public and private networking
- Understanding AWS IAM

### Linux

- Ubuntu server administration
- Package installation
- Apache configuration
- File permissions
- Linux services

### Web Development

- Apache web server
- PHP
- HTML
- CSS
- Form handling

### Database

- MySQL
- SQL
- Database creation
- Table creation
- INSERT operations
- SELECT operations
- PHP-to-MySQL connectivity

### Security

- Restricting SSH access
- Protecting credentials
- Security Group configuration
- Database access control
- Principle of least privilege

---

# 🎓 Project Evaluation Explanation

During project evaluation, the architecture can be explained as follows:

> This project is a cloud-hosted Student Management Portal based on the LAMP architecture. I deployed an Ubuntu Linux server on Amazon EC2. Apache acts as the web server and PHP handles the application logic. Student information is stored in Amazon RDS MySQL instead of being stored locally on the EC2 instance. The PHP application connects to RDS using MySQL on port 3306. AWS Security Groups control network access. HTTP port 80 is open for users to access the application, while SSH port 22 is restricted to my administrator IP. The database is protected by restricting database access to the application server. This architecture separates the web application from the database and uses managed AWS services for compute and database infrastructure.

---

---

## Where is the student data stored?

The student information is stored in:

```text
Amazon RDS
    ↓
MySQL
    ↓
student_db
    ↓
students
```

---

## What happens if the EC2 server is stopped?

The web application becomes unavailable because Apache and PHP are running on the EC2 instance.

The RDS database remains a separate managed service.

---

## What happens if the EC2 public IP changes?

The URL using the old public IP will no longer work.

An Elastic IP or a domain name can be used for a more stable endpoint.

---

# 📊 Project Summary

| ComponentImplementation |                 |
| ----------------------- | --------------- |
| Cloud Platform          | AWS             |
| Compute                 | Amazon EC2      |
| OS                      | Ubuntu Linux    |
| Web Server              | Apache          |
| Application             | PHP             |
| Database                | Amazon RDS      |
| DB Engine               | MySQL 8.4.9     |
| Database Name           | `student_db`    |
| Table                   | `students`      |
| Networking              | Amazon VPC      |
| Firewall                | Security Groups |
| Monitoring              | CloudWatch      |
| Access Management       | IAM             |

---

# 🎯 Project Outcome

The final application demonstrates a working cloud-based LAMP architecture.

The application successfully provides:

```text
User
  ↓
Web Browser
  ↓
Apache
  ↓
PHP
  ↓
Amazon RDS MySQL
  ↓
student_db
  ↓
students table
```

The project demonstrates practical knowledge of:

- Cloud computing
- AWS EC2
- AWS RDS
- Linux
- Apache
- PHP
- MySQL
- SQL
- VPC networking
- Security Groups
- IAM
- Web application deployment

---

# 🏆 Conclusion

The **AWS LAMP Student Portal** demonstrates how a traditional PHP and MySQL application can be deployed using AWS cloud infrastructure.

Amazon EC2 provides the compute environment, Apache serves the PHP application, and Amazon RDS provides the managed MySQL database.

The project also demonstrates important cloud security practices including restricted SSH access, Security Group configuration and protection of database credentials.

This project provides a foundation that can be extended into a more advanced Student Management System with authentication, CRUD operations, dashboards, HTTPS, monitoring and automated deployment.

---

# 👨‍💻 Author

**Yashodhan Kolhe**

MCA Student

---

# 📚 Project Type

**Academic / Educational AWS Cloud Project**

---
