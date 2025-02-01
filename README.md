### **Laravel Course and Student Management System**

#### **Project Overview**

This is a application that allows a **Super Admin** to manage courses and students, assign students to courses, and view detailed analytics through a dashboard.

The system includes:

- **Super Admin Dashboard** for managing courses and students.
- **Course & Student Management** with enrollment functionality.
- **Authentication & Access Control** to restrict unauthorized users.
- **Modern UI**.

---

## **Installation & Setup**

### **1.Clone the Repository**

```sh
git clone https://github.com/NalindaGamaarachchi/course-student-management.git
cd course-student-management
```

### **2.Install Dependencies**

```sh
composer install
npm install
```

### **3.Set Up Environment**

- Copy `.env.example` to `.env`

```sh
cp .env.example .env
```

- Generate an application key

```sh
php artisan key:generate
```

- Configure **database settings** in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### **4.Run Migrations & Seed Data**

```sh
php artisan migrate --seed
```

This will **create the required tables** and **seed the database with demo data**.

---

## **Admin Credentials**

Use the following credentials to log in as **Super Admin**:

- **Email:** `admin@example.com`
- **Password:** `password123`

---

## **Running the Project**

### **Start the Server**

```sh
php artisan serve
```

Now, open **[http://127.0.0.1:8000](http://127.0.0.1:8000)** in your browser.

---


## **Important Routes**

| Feature | Route |
|---------|----------------|
| **Welcome Page** | `/` |
| **Login** | `/login` |
| **Dashboard** (Super Admin) | `/dashboard` |
| **Courses Management** | `/courses` |
| **Students Management** | `/students` |

