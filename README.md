# Dashboard AI v2

Sistem Penilaian proposal penelitian/pengabdian dengan integrasi AI/ML model.

## 🎯 Fitur Utama

-   **Web Bima Integration**: Terima data proposal dari sistem eksternal
-   **AI Model Evaluation**: Kirim data ke model komputasi untuk Penilaian otomatis
-   **Result Management**: Tampilkan dan kelola hasil Penilaian
-   **File Storage**: Upload dan storage management untuk file proposal
-   **User Management**: Role-based access dengan Jetstream + Spatie Permission

---

## 📋 System Requirements

-   **PHP** 8.2 atau lebih tinggi
-   **Composer** 2.x
-   **Node.js** 18.x atau lebih tinggi & NPM
-   **MySQL** 8.0 atau lebih tinggi (atau SQLite untuk development)
-   **Web Server**: Apache/Nginx (untuk production)
-   **OS**: Ubuntu 20.04/22.04 atau Windows 10/11

---

## 🖥️ VPS Setup (Production)

### A. Setup Ubuntu Server (20.04/22.04)

#### 1. Update System

```bash
sudo apt update && sudo apt upgrade -y
```

#### 2. Install PHP 8.2 & Extensions

```bash
# Add PHP Repository
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Install PHP 8.2 and required extensions
sudo apt install -y php8.2 php8.2-fpm php8.2-cli php8.2-common \
    php8.2-mysql php8.2-xml php8.2-xmlrpc php8.2-curl \
    php8.2-gd php8.2-imagick php8.2-cli php8.2-dev \
    php8.2-imap php8.2-mbstring php8.2-opcache \
    php8.2-soap php8.2-zip php8.2-intl php8.2-bcmath

# Verify PHP version
php -v
```

#### 3. Install Composer

```bash
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
composer --version
```

#### 4. Install Node.js & NPM

```bash
# Install Node.js 18.x
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

# Verify installation
node -v
npm -v
```

#### 5. Install MySQL Server

```bash
# Install MySQL
sudo apt install -y mysql-server

# Secure MySQL installation
sudo mysql_secure_installation

# Login to MySQL
sudo mysql

# Create database and user
CREATE DATABASE dashboardai_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'dashboardai_user'@'localhost' IDENTIFIED BY 'your_strong_password';
GRANT ALL PRIVILEGES ON dashboardai_db.* TO 'dashboardai_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 6. Install Nginx

```bash
sudo apt install -y nginx

# Start and enable Nginx
sudo systemctl start nginx
sudo systemctl enable nginx
```

#### 7. Configure Nginx for Laravel

```bash
sudo nano /etc/nginx/sites-available/dashboardai
```

Add this configuration:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/DashboardAIv2/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:

```bash
sudo ln -s /etc/nginx/sites-available/dashboardai /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

#### 8. Setup SSL with Let's Encrypt (Optional but Recommended)

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d your-domain.com
```

---

### B. Setup Windows Server

#### 1. Install XAMPP or Laragon

**Option A: XAMPP**

-   Download dari https://www.apachefriends.org/
-   Install dengan PHP 8.2+, MySQL, Apache

**Option B: Laragon (Recommended)**

-   Download dari https://laragon.org/
-   Sudah include PHP, MySQL, Node.js
-   Lebih mudah untuk development

#### 2. Install Composer

-   Download dari https://getcomposer.org/download/
-   Run installer dan ikuti wizard
-   Verify: `composer --version`

#### 3. Install Node.js

-   Download dari https://nodejs.org/ (LTS version)
-   Run installer
-   Verify: `node -v` dan `npm -v`

#### 4. Configure MySQL

-   Buka phpMyAdmin di http://localhost/phpmyadmin
-   Create database `dashboardai_db`
-   Create user dengan privileges

---

## 🚀 Installation

### 1. Clone Repository

**Ubuntu:**

```bash
cd /var/www
sudo git clone https://github.com/yogiok1/DashboardAIv2.git
sudo chown -R www-data:www-data DashboardAIv2
sudo chmod -R 755 DashboardAIv2
cd DashboardAIv2
```

**Windows:**

```bash
cd C:\laragon\www
git clone https://github.com/yogiok1/DashboardAIv2.git
cd DashboardAIv2
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

**For MySQL (Production):**

```env
APP_NAME="Dashboard AI v2"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dashboardai_db
DB_USERNAME=dashboardai_user
DB_PASSWORD=your_strong_password

# AI Model Endpoint (RunPod or your AI service)
AI_MODEL_ENDPOINT=https://3amy6t59zvmikl-8000.proxy.runpod.net/data
```

**For SQLite (Development):**

```env
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=sqlite
# DB_DATABASE akan auto gunakan database/database.sqlite
```

### 4. Database Setup

**MySQL:**

```bash
php artisan migrate --seed
```

**SQLite:**

```bash
touch database/database.sqlite
php artisan migrate --seed
```

### 5. Storage Setup

```bash
php artisan storage:link
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache  # Ubuntu only
```

### 6. Build Assets

**Development:**

```bash
npm run dev
```

**Production:**

```bash
npm run build
```

### 7. Start Application

**Development:**

```bash
php artisan serve
```

Access: http://127.0.0.1:8000

**Production (Ubuntu):**

-   Nginx sudah configured
-   Access: http://your-domain.com

---

## 👤 Default User Accounts

After seeding, you can login with:

| Role  | Email             | Password |
| ----- | ----------------- | -------- |
| Admin | admin@example.com | password |
| User  | user@example.com  | password |

**⚠️ IMPORTANT**: Change these passwords immediately in production!

---

## 🔧 Configuration

### File Upload Limits

Edit `php.ini`:

```ini
upload_max_filesize = 100M
post_max_size = 100M
max_execution_time = 300
```

Restart PHP-FPM:

```bash
sudo systemctl restart php8.2-fpm  # Ubuntu
```

### Queue Worker (Optional)

For background jobs:

```bash
php artisan queue:work
```

Setup as systemd service (Ubuntu):

```bash
sudo nano /etc/systemd/system/dashboardai-worker.service
```

```ini
[Unit]
Description=Dashboard AI Queue Worker

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/DashboardAIv2/artisan queue:work

[Install]
WantedBy=multi-user.target
```

```bash
sudo systemctl enable dashboardai-worker
sudo systemctl start dashboardai-worker
```

---

## 📁 Project Structure

```
DashboardAIv2/
├── app/
│   ├── Http/Controllers/
│   │   ├── Api/                    # API Controllers
│   │   │   ├── EvaluationResultController.php
│   │   │   ├── ProposalGroupApiController.php
│   │   │   └── ...
│   │   └── ...
│   ├── Models/
│   │   ├── Proposal.php
│   │   ├── ProposalGroup.php
│   │   └── ...
│   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── tools/                  # AI Tools Page
│   │   ├── proposal-results/       # Results Pages
│   │   └── ...
│   └── js/
├── routes/
│   ├── web.php                     # Web Routes
│   ├── api.php                     # API Routes
│   └── ...
├── storage/
│   └── app/
│       └── public/
│           └── proposals/          # Uploaded Files
├── .env                            # Environment Config
└── README.md                       # This file
```

---

## 🔄 System Architecture

### Data Flow

```
┌─────────────────┐
│   WEB BIMA      │ (External System)
└────────┬────────┘
         │ POST /api/bima/*
         ▼
┌─────────────────────────────────┐
│     DASHBOARD AI (Main Web)     │
│  1. Receive from Bima           │
│  2. Store files to storage/     │
│  3. Save to database            │
│                                 │
│  4. Send to AI Model  ─────────┼───►  ┌─────────────────┐
│     POST /api/evaluation-test   │      │  AI SERVICE     │
│                                 │      │  (RunPod)       │
│  6. Receive callback ◄──────────┼───── │                 │
│     POST /api/evaluation-result │      └─────────────────┘
│  7. Display in Results page     │
└─────────────────────────────────┘
```

### Key Endpoints

-   **Frontend Trigger**: `/tools` → User clicks "Run Model Test"
-   **Backend Forward**: `/api/evaluation-test` → Forwards to AI_MODEL_ENDPOINT
-   **AI Callback**: `/api/evaluation-result` → Receives results from AI
-   **Display**: `/proposal-results/{id}/detail` → Shows evaluation

---

## 📝 Recent Updates

### Version 2.3 (December 2025)

-   ✅ Fixed `/tools` page form submission issue
-   ✅ Implemented proper API flow: Frontend → Backend → AI Service
-   ✅ Added success/error notifications (similar to upload page)
-   ✅ Removed debug logs and test buttons
-   ✅ Enhanced user experience with visual feedback
-   ✅ Consolidated documentation

### Version 2.2

-   ✅ Added evaluation result callback endpoint
-   ✅ Implemented proposal group loading via AJAX
-   ✅ Added comprehensive logging system

### Version 2.1

-   ✅ Web Bima integration APIs
-   ✅ File upload and storage management
-   ✅ AI Model testing interface

---

## 🐛 Troubleshooting

### Permission Issues (Ubuntu)

```bash
sudo chown -R www-data:www-data /var/www/DashboardAIv2
sudo chmod -R 775 storage bootstrap/cache
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### NPM Build Issues

```bash
rm -rf node_modules package-lock.json
npm install
npm run build
```

### Database Connection Issues

-   Check `.env` credentials
-   Verify MySQL service is running: `sudo systemctl status mysql`
-   Test connection: `php artisan tinker` → `DB::connection()->getPdo();`

---

## 📚 Additional Documentation

-   **API Documentation**: See [README_API.md](README_API.md)
-   **Laravel Docs**: https://laravel.com/docs
-   **Jetstream**: https://jetstream.laravel.com

---

## 📧 Support

For issues and questions:

-   **GitHub Issues**: https://github.com/yogiok1/DashboardAIv2/issues
-   **Email**: support@your-domain.com

---

## 📄 License

This project is proprietary software. All rights reserved.

php artisan migrate

# Seed initial data (roles & admin user)

php artisan db:seed

````

### 4. Storage Setup

```bash
php artisan storage:link
````

### 5. Run Application

```bash
# Start Laravel server
php artisan serve

# In another terminal, compile assets
npm run dev
```

Aplikasi akan running di: `http://localhost:8000`

## 📚 Documentation

-   **[README_API.md](README_API.md)** - Dokumentasi lengkap API endpoints
-   **[SYSTEM_FLOW.md](SYSTEM_FLOW.md)** - Penjelasan detail system flow dan integrasi

## 🔄 System Flow

### 1. Web Bima → Dashboard AI

Web Bima upload proposal via API → Dashboard AI simpan ke storage + database

### 2. Dashboard AI → Model Komputasi

User klik "Run Model Test" → Dashboard AI kirim data → Model Komputasi Penilaian → Return scores

### 3. Dashboard AI → User

User lihat hasil Penilaian di halaman Results dengan scores dari AI model

Detail flow ada di [SYSTEM_FLOW.md](SYSTEM_FLOW.md)

## 🔧 API Endpoints

### Web Bima Integration

-   `POST /api/bima/proposal-groups` - Upload proposal groups
-   `POST /api/bima/rubrics` - Upload rubrics
-   `POST /api/bima/metadata` - Upload metadata

### Data Import

-   `POST /api/data/import` - Import data internal
-   `GET /api/data/status` - Status query

### Model Testing

-   `POST /api/model/direct-test` - Direct test (AKTIF)
-   ~~`POST /api/model/test`~~ - Test single group (DEPRECATED)
-   ~~`POST /api/model/batch-test`~~ - Batch testing (DEPRECATED)

Detail API ada di [README_API.md](README_API.md)

## 🗄️ Database Tables

-   `users` - User management
-   `proposal_groups` - Kelompok proposal
-   `proposals` - File proposal individual
-   `proposal_group_results` - Hasil Penilaian dari AI model
-   `rubrics` - Rubrik penilaian
-   `metadata` - Metadata penelitian

## 👤 Default Users

Setelah `php artisan db:seed`:

**Admin**

-   Email: `admin@example.com`
-   Password: `password`

**Regular User**

-   Email: `user@example.com`
-   Password: `password`

## 📁 File Storage

Files disimpan di:

```
storage/app/public/
├── proposals/     # Proposal files
├── rubrics/       # Rubric files
└── metadata/      # Metadata files
```

Public access via: `public/storage/` (after `php artisan storage:link`)

## 🧪 Testing

### Test Web Bima API

```powershell
$body = @{
    scheme = "PPDM"
    type = "current"
    path = "training"
    group_name = "Test Group"
    proposals = @(@{
        filename = "test.pdf"
        file_base64 = "JVBERi0xLjQK..."
    })
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:8000/api/bima/proposal-groups" `
    -Method POST -ContentType "application/json" -Body $body
```

### Test Model Testing API

```powershell
# Request DIRECT ke AI Model
$body = @{
    instrument_path = "Instrumen"
    scheme = "Penelitian Terapan"
    proposals = @(
        @{
            filename = "proposal_1.pdf"
            filepath = "/storage/test/proposal_1.pdf"
            status = "done"
        },
        @{
            filename = "proposal_2.pdf"
            filepath = "/storage/test/proposal_2.pdf"
            status = "failed"
        }
    )
} | ConvertTo-Json -Depth 10

Invoke-RestMethod -Uri "http://localhost:8000/api/model/direct-test" `
    -Method POST -ContentType "application/json" -Body $body
```

**Format**: Kirim langsung data sesuai format yang dibutuhkan AI Model (konsep group dikomentar dulu)

## 🔐 Security

-   API saat ini **belum** menggunakan authentication (development mode)
-   Untuk production, tambahkan `auth:sanctum` middleware
-   Configure CORS jika Web Bima dari domain berbeda

## 📝 Logs

Check application logs:

```bash
tail -f storage/logs/laravel.log
```

## 🛠️ Tech Stack

-   **Framework**: Laravel 12
-   **Frontend**: Livewire 3, TailwindCSS, Alpine.js
-   **Authentication**: Laravel Jetstream + Sanctum
-   **Permissions**: Spatie Laravel Permission
-   **Database**: SQLite (configurable)

## 📞 Support

Jika ada masalah:

1. Check logs: `storage/logs/laravel.log`
2. Enable debug: set `APP_DEBUG=true` di `.env`
3. Review dokumentasi API dan system flow

---

## 🆕 Latest Updates (December 2025)

### Proposal Results Enhancements

#### Progress Bar & Computation Time Tracking

-   **Progress Bar**: Visual progress indicator showing evaluation completion percentage
-   **Total Computation Time**: Displays cumulative processing time for all evaluated proposals
-   **Average Time per Proposal**: Shows average computation time per proposal
-   Available at `/proposal-results` page

#### Result Detail Page Improvements

-   **Fixed Acceptance Status**: ML result now correctly displays LOLOS/TIDAK_LOLOS status
-   **Final Summary Display**: Added final evaluation summary section in detail modal
-   Enhanced status badges with consistent formatting
-   Better visualization of evaluation results

### Schema Management System

#### Schema Model

-   New `schemas` table for storing evaluation schemas
-   JSON-based schema data structure
-   Support for multiple schema types (rubric, instrument, etc.)
-   Automatic schema creation when uploading rubrics

**Schema Table Structure**:

```php
id               // Primary key
name             // Schema name
description      // Optional description
schema_data      // JSON structure containing schema details
type             // Schema type (rubric, instrument, etc.)
created_at
updated_at
```

### Rubric Management Updates

#### Multiple File Upload Support

-   **Two File Upload**: Support for uploading 2 DOCX files per rubric
-   **DOCX Only**: Restricted to .docx format for consistency
-   **Schema Integration**: Each rubric automatically creates associated schema
-   **Description Field**: Added optional description for rubrics

#### Updated Rubrics Features:

-   File size limit: 10MB per file
-   Downloadable files with separate download buttons
-   Schema reference for each rubric
-   Enhanced file management interface

**Rubrics Table Structure**:

```php
id               // Primary key
rubric_name      // Rubric name
description      // Optional description
file_path        // Path to first DOCX file
file_path_2      // Path to second DOCX file (optional)
schema_id        // Foreign key to schemas table
created_at
updated_at
```

### Migration Commands

Run these migrations to apply the updates:

```bash
# Create schemas table
php artisan migrate --path=database/migrations/2025_12_18_071236_create_schemas_table.php

# Update rubrics table
php artisan migrate --path=database/migrations/2025_12_18_071641_update_rubrics_table_for_multiple_files_and_schema.php
```

---

**Version**: 2.0  
**Last Updated**: December 2025
