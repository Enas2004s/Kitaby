# Kitaby

Kitaby is a university platform that helps students share books and study materials in a simple and organized way.

The platform was created to support students by making it easier to exchange physical books and upload useful PDF files, especially in difficult circumstances where access to study resources may be limited.

---

## Project Idea

The main idea of Kitaby is based on two types of study materials:

1. **Physical Books**
   - A student can add a book they own.
   - Another student can request that book.
   - The owner can approve or reject the request.

2. **PDF Files**
   - A student can upload study files or digital books.
   - Other students can view or download them directly.

---

## Main Features

- User registration and login
- Add, edit, and delete books
- Upload book images and PDF files
- Organize books by categories
- Search for books
- Request physical books
- Approve or reject requests
- View My Books
- View My Requests
- Default categories added through Seeder

---

## Categories

The platform includes default categories such as:

- Academic Books
- Scientific Resources
- Technology & IT
- Study Summaries
- Past Exams

---

## Technologies Used

- Laravel
- PHP
- MySQL
- Blade
- HTML
- CSS
- GitHub

---

## Team Members

- Enas
- Raghd
- Malak

---

## How to Run the Project

1. Open XAMPP and start **Apache** and **MySQL**
2. Open the project folder
3. Configure the `.env` file
4. Run migrations:
   ```bash
    php artisan migrate
    php artisan db:seed
    php artisan serve
