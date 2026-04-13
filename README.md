# Server Side - Job Board Application

Laravel-based job board web application that connects employers and job seekers.
This project was developed as part of the Server Side CA2. The system allows employers to create and manage job listings, while job seekers can browse and apply for jobs.

---

## Team Members

- Michal Salabura - Employer Features
- Oliver Halpenny - Job Seeker Features

### Responsibilities

**Employer Side:**

- Employer registration & authentication
- Job listings CRUD
- Employer profile management
- Viewing applications per listing
- Notification system for new applications
- Role-based middleware protection

**Job Seeker Side:**

-
-

---

## Technologies Used

- PHP 8.5 (Laravel 13)
- Laravel Breeze (Authentication)
- Blade (Templating Engine)
- Bootstrap 5 (Styling)
- MySQL (Database)
- Git & GitHub (Version Control)
- XAMPP (Local Development)

---

## Features

### Employer Features

- Register and login as employer
- Employer dashboard with job count and recent listings
- Create, edit, delete job listings
- Custom company name per job listing
- View applications for each job listing
- Edit company profile (name, description, location, website)
- Basic notification system (alerts for new applications in last 7 days)
- Route protection via middleware (employer-only access)
- Authorization checks (employers can only modify their own listings)

### Job Seeker Features

-
-
-

---

## Database Structure

- `users` (with role: employer/jobseeker)
- `employer_profiles`
- `job_listings`
- `applications`

### Relationships

- One user (employer) has one employer profile
- One employer has many job listings
- One job listing has many applications
- One user (jobseeker) has many applications

---

## Installation

1. Clone the repository:

```bash
git clone github.com/MichalSalabura/server-side-ca2-job-board
cd server-side-ca2-job-board
```

2. Install dependencies:

```bash
composer install
npm install
```

3. Set up environment file:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_board
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations:

```bash
php artisan migrate
```

6. Build assets:

```bash
npm run dev
```

7. Start the server:

```bash
php artisan serve
```

Visit `http://localhost:8000`

---

## Git Workflow

- `main` — stable, fully working version
- `dev` — integration branch
- `feature/` — new feature development
- `fix/` — bug fixes
- `chore/` — non-code tasks (README, config, etc.)

---

## Assumptions and Limitations

- Notification system is count-based, no email notifications
- No admin panel
- Authentication handled by Laravel Breeze

---

## Known Issues

- None at time of submission
