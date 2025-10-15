# User Management System

A Laravel-based user management system with enhanced security features including forced password change for new users, Georgian phone number validation, and comprehensive user authentication.

ლარაველზე დაფუძნებული მომხმარებლების მართვის სისტემა გაძლიერებული უსაფრთხოების ფუნქციებით, მათ შორის ახალი მომხმარებლების იძულებითი პაროლის ცვლილება, ტელეფონის ნომრებისა და იმეილის ვალიდაცია და სრულყოფილი ავთენტიფიკაცია.

## Features / ფუნქციონალი

- User registration and authentication / მომხმარებლის რეგისტრაცია და ავთენტიფიკაცია
- Login with email or phone number / შესვლა ელ-ფოსტით ან ტელეფონის ნომრით
- Password reset functionality / პაროლის აღდგენის ფუნქციონალი
- Profile management / პროფილის მართვა
- User registration by authenticated users / ავთენტიფიცირებული მომხმარებლების მიერ ახალი მომხმარებლების დამატება
- Forced password change for new users registered by authenticated users / ავთენტიფიცირებული მომხმარებლების მიერ დამატებული მომხმარებლების იძულებითი პაროლის ცვლილება

## Requirements / მოთხოვნები

- PHP >= 8.1
- Composer
- XAMPP (with MySQL >= 5.7)

## Installation / ინსტალაცია

1. Start XAMPP and ensure Apache and MySQL services are running
```bash
- Open XAMPP Control Panel
- Start Apache
- Start MySQL
```

2. Create the database / მონაცემთა ბაზის შექმნა
```bash
- Open localhost/phpmyadmin in your browser
- Create new database named: laravel_authentication_system
```

3. Clone the repository into XAMPP's htdocs folder / რეპოზიტორიის კლონირება XAMPP-ის htdocs საქაღალდეში
```bash
cd C:\xampp\htdocs
git clone https://github.com/YourUsername/YourRepository.git
cd YourRepository
```

4. Install PHP dependencies / PHP დამოკიდებულებების ინსტალაცია
```bash
composer install
```

5. Copy environment file / გარემოს ფაილის კოპირება
```bash
cp .env.example .env
```

6. Generate application key / აპლიკაციის გასაღების გენერაცია
```bash
php artisan key:generate
```
The key will be automatically added to your .env file.

7. Configure your .env file / .env ფაილის კონფიგურაცია
```env
APP_NAME="User Management"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost/YourRepository
#IN MOST CASES: APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_authentication_system
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

#MAIL SERVER CONFIG
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail-username
MAIL_PASSWORD=16-digit-code
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-gmail-address"
MAIL_FROM_NAME="your-gmail-name"
```

8. Create necessary database tables / საჭირო ცხრილების შექმნა
```bash
php artisan migrate
```

9. Start the queue worker for mail system to work properly / Queue worker-ის გაშვება მეილ სისტემისთვის
```bash
php artisan queue:work
```

10. Set proper permissions (if on Linux/Mac) / უფლებების მინიჭება (Linux/Mac სისტემებზე)
```bash
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

## Accessing the Application / აპლიკაციაზე წვდომა

After installation, you can access the application at:
```
http://localhost/YourRepository/public
```

If you want to use virtual hosts or a different setup, modify your Apache configuration accordingly.

## Troubleshooting / პრობლემების გადაჭრა

If you encounter any issues:

1. Make sure all XAMPP services are running
2. Verify database connection settings in .env
3. Clear Laravel cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```
4. Check storage folder permissions
5. Ensure all required PHP extensions are enabled in php.ini

## License / ლიცენზია

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Laravel ფრეიმვორქი არის ღია წყაროს პროგრამული უზრუნველყოფა [MIT ლიცენზიით](https://opensource.org/licenses/MIT).