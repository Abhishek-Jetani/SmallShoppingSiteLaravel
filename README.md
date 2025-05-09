Small Shopping Site
Small Shopping Site is a Laravel-based eCommerce platform designed for managing products, orders, users, and administrative tasks efficiently.

Features
Admin Dashboard: Manage users, products, categories, orders, and site settings.

User Dashboard: View orders, manage profile, wishlist, and cart.

Product Management: Add, edit, delete, and categorize products.

Order Management: Place orders, manage order details, and generate order-related reports.

Authentication and Authorization: Secure user authentication and role-based access control.

Stripe Payment Integration: Seamless checkout process with Stripe payment gateway.

Static Pages: About Us, Privacy Policy, and Terms & Conditions pages.

Installation
Clone the repository: git clone https://github.com/Abhishek-Jetani/SmallShoppingSiteLaravel.git

Install dependencies: composer install

Copy .env.example to .env and configure your environment variables:

bash
Copy
Edit
cp .env.example .env
Generate application key: php artisan key:generate

Run migrations: php artisan migrate

Serve the application: php artisan serve

Usage
Access the application at http://localhost:8000.

Login as admin using credentials provided during installation.

Explore different sections of the application based on your role (admin or user).

Customize routes and controllers as per your business logic.

Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your improvements.

License
This project is licensed under the MIT License - see the LICENSE file for details.
