# Laravel Order Reminder Microservice

This is a Laravel-based microservice that manages order reminders based on configurable intervals. It fetches order data, schedules reminders, and sends automated emails before and after order expiration.

## 🚀 Features
- Fetches orders from different business services.
- Dynamically schedules pre- and post-expiration reminders.
- Sends automated email notifications with a customizable template.
- Supports Laravel Sail for a Docker-based development environment.

---

## 📌 Prerequisites
Ensure you have the following installed on your system:
- **Docker** (for Laravel Sail)
- **Git**
- **Composer**
- **PHP 8.1+** (if running without Docker)

---

## 📥 Installation

### 1️⃣ **Clone the Repository**
```sh
git clone https://github.com/your-repo/your-project.git
cd your-project

2️⃣ Copy the Environment File
cp .env.example .env

3️⃣ Start Laravel Sail
./vendor/bin/sail up -d

4️⃣ Install Dependencies
./vendor/bin/sail composer install

5️⃣ Generate the Application Key
./vendor/bin/sail artisan key:generate

5️⃣ Run the miogrations
./vendor/bin/sail artisan migrate --seed

6️⃣ Run Migrations
./vendor/bin/sail artisan queue:work

7️⃣ Queue & Scheduler Setup
./vendor/bin/sail artisan queue:work

Schedule the reminder task in app/Console/Kernel.php:

protected function schedule(Schedule $schedule)
{
    $schedule->command('reminders:send')->everyMinute();
}


🏗 Running the Application

✅ Run Laravel Development Server
./vendor/bin/sail artisan serve

✅ Trigger Reminder Email Manually
./vendor/bin/sail artisan reminders:send

🛠 Testing
Run tests inside the Sail container:
./vendor/bin/sail artisan test
