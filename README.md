# 🏠 Housing App — Laravel + Docker

A room listing web application built with Laravel 11, Docker, and MySQL — based on the original `housing.sql` schema.

---

## 📋 Database Schema

| Table | Primary Key | Description |
|-------|-------------|-------------|
| `member` | `member_id` | Users who register and list rooms |
| `house` | `house_id` | Room listings posted by members |
| `history_view` | `view_id` | Tracks which member viewed which house |

---

## 🛠 Tech Stack

- **PHP** 8.2
- **Laravel** 11
- **MySQL** 8.0
- **Nginx** (web server)
- **Docker** + Docker Compose
- **Tailwind CSS** (via CDN)
- **phpMyAdmin** (database UI)

---

## 📁 Project Structure

```
housing-app/
├── app/
│   ├── Models/
│   │   ├── Member.php          ← auth model (member table)
│   │   ├── House.php           ← house table
│   │   └── HistoryView.php     ← history_view table
│   └── Http/Controllers/
│       ├── HouseController.php
│       └── Auth/
│           └── MemberAuthController.php
├── database/migrations/
│   ├── ..._create_member_table.php
│   ├── ..._create_house_table.php
│   └── ..._create_history_view_table.php
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── houses/
│   │   ├── index.blade.php     ← all listings
│   │   ├── show.blade.php      ← single listing
│   │   ├── create.blade.php    ← add new listing
│   │   └── edit.blade.php      ← edit listing
│   └── auth/
│       ├── login.blade.php
│       └── register.blade.php
├── routes/web.php
├── docker-compose.yml
├── Dockerfile
└── docker/nginx/nginx.conf
```

---

## ⚙️ Requirements

- Docker Desktop (running)
- Mac with Apple Silicon (M1/M2/M3) or Intel

---

## 🚀 Installation & Setup

### Step 1 — Clone or download the project

```bash
cd ~/Desktop
cd housing-app
```

### Step 2 — Start Docker containers

```bash
docker-compose up -d --build
```

Wait ~30 seconds for MySQL to fully initialize.

### Step 3 — Generate app key

```bash
docker-compose exec app php artisan key:generate
```

### Step 4 — Run database migrations

```bash
docker-compose exec app php artisan migrate
```

### Step 5 — Clear config cache

```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
```

### Step 6 — Build frontend assets

```bash
npm install
npm run build
```

> If npm is not on your Mac: `brew install node`

---

## 🌐 URLs

| URL | Description |
|-----|-------------|
| http://localhost:8000 | Main app |
| http://localhost:8000/register | Register a new account |
| http://localhost:8000/login | Login |
| http://localhost:8000/houses | All room listings |
| http://localhost:8000/houses/create | Post a new listing (login required) To be continue|
| http://localhost:8080 | phpMyAdmin (database UI) |

---

## 🗄 Database Access (phpMyAdmin)

Open **http://localhost:8080** in your browser.

```
Host:     db
User:     housing_user
Password: secret
Database: housing_db
```

---

## 🐳 Docker Commands

```bash
# Start all containers
docker-compose up -d

# Stop all containers
docker-compose down

# Stop and delete database (fresh start)
docker-compose down -v

# Rebuild after Dockerfile changes
docker-compose build --no-cache
docker-compose up -d

# View logs
docker-compose logs -f app
docker-compose logs -f db

# Run artisan commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan migrate:fresh
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear

# Open MySQL terminal
docker-compose exec db mysql -uhousing_user -psecret housing_db
```

---

## 🔐 Authentication

| Feature | Details |
|---------|---------|
| Register | Name, email, password, mobile number |
| Login | Email + password |
| Logout | Session cleared |
| Auth model | `App\Models\Member` (extends `Authenticatable`) |
| Guard | `web` → provider `members` → `Member::class` |

---

## 📌 Key Configuration Notes

### config/auth.php
```php
'guards' => [
    'web' => [
        'driver'   => 'session',
        'provider' => 'members',
    ],
],
'providers' => [
    'members' => [
        'driver' => 'eloquent',
        'model'  => App\Models\Member::class,
    ],
],
```

### .env database settings
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=housing_db
DB_USERNAME=housing_user
DB_PASSWORD=secret
```

FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip
---

## 🐛 Docker file

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Node.js 20 and npm (each on its own RUN line)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs
RUN node -v && npm -v

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

---

## 🐛 Common Errors & Fixes

| Error | Fix |
|-------|-----|
| `getaddrinfo for db failed` | Add `platform: linux/amd64` to db in docker-compose.yml |
| `Connection refused` | Add `command: --default-authentication-plugin=mysql_native_password` to db service |
| `Table already exists` | Run `docker-compose exec app php artisan migrate:fresh` |
| `View not found` | Create the missing file in `resources/views/` |
| `SessionGuard null provider` | Check `config/auth.php` provider key matches guard |
| `Member must be Authenticatable` | Member model must extend `Illuminate\Foundation\Auth\User` not `Model` |

---

## 👤 Author

Built from original PHP housing project by **Thiri** — migrated to Laravel 11 + Docker.
