# Activity No. 2: Creating CRUD Modules in Laravel

# Laravel Product CRUD Web Application

This project was developed as part of **Activity No. 2: Creating CRUD Modules in Laravel** for the course **CCC181 — Web Systems and Technologies**.

The activity demonstrates the implementation of a simple **Product Management CRUD system** using Laravel, Blade templates, Eloquent ORM, Controllers, Routes, and MySQL.

The system allows users to:

- Create products
- View products
- Edit existing products
- Delete products
- Store product information in a MySQL database
- Validate product information before saving
- Navigate through the application using Laravel routes

---

# Project Overview

The purpose of this project is to demonstrate the basic **CRUD operations**:

| Operation | Description |
|---|---|
| Create | Add a new product |
| Read | Display all products |
| Update | Edit and update an existing product |
| Delete | Remove a product |

The application uses the **MVC (Model-View-Controller)** architecture provided by Laravel.

The Product CRUD module is connected to a MySQL database and uses Laravel's **Eloquent ORM** to communicate with the database.

---

# Learning Objectives

After completing this activity, the student should be able to:

1. Explain the concept of CRUD operations.
2. Create Blade views for a Laravel application.
3. Implement Eloquent ORM for database operations.
4. Develop a simple CRUD module using Laravel.
5. Integrate Models, Views, Controllers, Routes, and MySQL.
6. Apply form validation to user input.
7. Use Git and GitHub to manage and submit the project.

---

# Technologies Used

- **Laravel 9.52.22**
- **PHP 8.0.30**
- **MySQL**
- **XAMPP**
- **Visual Studio Code**
- **Composer**
- **Git**
- **GitHub**
- **Blade Templates**
- **Eloquent ORM**

---

# System Architecture

This project follows the Laravel MVC architecture.

```text
                    ┌──────────────────┐
                    │      Browser     │
                    └────────┬─────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │   routes/web.php │
                    └────────┬─────────┘
                             │
                             ▼
                  ┌──────────────────────┐
                  │   ProductController  │
                  └───────┬───────┬──────┘
                          │       │
                    ┌─────┘       └─────┐
                    ▼                   ▼
             ┌─────────────┐     ┌─────────────┐
             │   Product   │     │ Blade Views │
             │    Model    │     │             │
             └──────┬──────┘     └─────────────┘
                    │
                    ▼
             ┌─────────────┐
             │    MySQL    │
             │  Database   │
             └─────────────┘
```

## MVC Components

### Model

The Product model communicates with the database using Laravel's Eloquent ORM.

### View

Blade templates display the product list and provide forms for creating and editing products.

### Controller

The ProductController handles requests and performs the CRUD operations.

---

# Project Structure

The main files used for the CRUD module are:

```text
laravel-crud-activity-2/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ProductController.php
│   │
│   └── Models/
│       └── Product.php
│
├── database/
│   └── migrations/
│       └── create_products_table.php
│
├── resources/
│   └── views/
│       └── products/
│           ├── index.blade.php
│           ├── create.blade.php
│           └── edit.blade.php
│
├── routes/
│   └── web.php
│
├── .env
├── artisan
├── composer.json
└── README.md
```

---

# Database Configuration

The project uses a MySQL database named:

```text
laravel_crud
```

The database connection is configured through the Laravel `.env` file.

The main database settings are:

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud
DB_USERNAME=root
DB_PASSWORD=
```

The MySQL database was created using XAMPP's MySQL service.

> The `.env` file is not included in the GitHub repository because it contains local configuration information.

---

# Product Database Table

The project contains a `products` table.

The table contains the following fields:

| Field | Type | Description |
|---|---|---|
| id | Big Integer | Unique product ID |
| name | String | Product name |
| qty | Integer | Product quantity |
| price | Decimal | Product price |
| description | Text | Product description |
| created_at | Timestamp | Record creation time |
| updated_at | Timestamp | Record update time |

The migration creates the table using Laravel's Schema Builder.

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('qty');
    $table->decimal('price', 8, 2);
    $table->text('description')->nullable();
    $table->timestamps();
});
```

The migration was executed using:

```bash
php artisan migrate
```

---

# Product Model

The Product model is located at:

```text
app/Models/Product.php
```

The model uses Eloquent ORM and defines the fields that can be assigned using mass assignment.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'qty',
        'price',
        'description'
    ];
}
```

## `$fillable`

The `$fillable` property specifies which fields are allowed for mass assignment.

This allows the application to safely use:

```php
Product::create(...)
```

and:

```php
$product->update(...)
```

---

# Product Controller

The ProductController is located at:

```text
app/Http/Controllers/ProductController.php
```

The controller contains the main CRUD operations.

## Index

The `index()` method retrieves all products:

```php
public function index()
{
    $products = Product::all();

    return view('products.index', compact('products'));
}
```

This displays the products in the Product List page.

---

## Create

The `create()` method displays the Add New Product form:

```php
public function create()
{
    return view('products.create');
}
```

---

## Store

The `store()` method validates and saves a new product.

The validation rules include:

```php
$request->validate([
    'name' => 'required|string|max:255',
    'qty' => 'required|integer|min:0',
    'price' => 'required|numeric|min:0',
]);
```

After validation, the product is created using:

```php
Product::create(
    $request->only('name', 'qty', 'price', 'description')
);
```

The user is then redirected back to the product list.

---

## Edit

The `edit()` method finds a product and displays the edit form:

```php
public function edit(string $id)
{
    $product = Product::findOrFail($id);

    return view('products.edit', compact('product'));
}
```

---

## Update

The `update()` method validates the new information and updates the selected product:

```php
$product = Product::findOrFail($id);

$product->update(
    $request->only('name', 'qty', 'price', 'description')
);
```

After the update, the user is redirected back to the Product List page.

---

## Destroy

The `destroy()` method deletes a product:

```php
public function destroy(string $id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()
        ->route('products.index')
        ->with('success', 'Product deleted successfully!');
}
```

After deletion, the user is redirected to the Product List page.

---

# Routes

The routes are located in:

```text
routes/web.php
```

The application uses Laravel's resource routing:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);
```

`Route::resource()` automatically creates the standard routes required for the CRUD operations.

---

# CRUD Route Mapping

| HTTP Method | URL | Controller Method | Purpose |
|---|---|---|---|
| GET | `/products` | index | Display products |
| GET | `/products/create` | create | Show create form |
| POST | `/products` | store | Save new product |
| GET | `/products/{id}/edit` | edit | Show edit form |
| PUT/PATCH | `/products/{id}` | update | Update product |
| DELETE | `/products/{id}` | destroy | Delete product |

---

# Blade Views

The project contains three main Blade views.

## 1. Product List

File:

```text
resources/views/products/index.blade.php
```

This page displays all products stored in the database.

It contains:

- Product ID
- Product name
- Quantity
- Price
- Description
- Edit button
- Delete button
- Add New Product button

If there are no products, the page displays an empty-state message.

The page also displays a success message after a product is successfully added, updated, or deleted.

---

## 2. Add New Product

File:

```text
resources/views/products/create.blade.php
```

This page contains a form for creating a new product.

The form accepts:

- Product name
- Quantity
- Price
- Description

Laravel's CSRF protection is included using:

```php
@csrf
```

Validation errors are also displayed when invalid information is submitted.

---

## 3. Edit Product

File:

```text
resources/views/products/edit.blade.php
```

This page allows the user to modify an existing product.

The existing product information is automatically placed into the form.

The form uses:

```php
@csrf
@method('PUT')
```

The PUT method is used to represent the update operation.

---

# Delete Operation

The delete form uses Laravel's CSRF protection and method spoofing:

```php
@csrf
@method('DELETE')
```

The user must also confirm the deletion before the product is removed.

The delete request is sent to the `destroy()` method of the ProductController.

---

# Form Validation

The application validates product information before storing or updating it.

The following rules are applied.

## Product Name

```text
Required
String
Maximum of 255 characters
```

## Quantity

```text
Required
Integer
Minimum value of 0
```

## Price

```text
Required
Numeric
Minimum value of 0
```

The application displays validation errors when the submitted information does not satisfy the validation rules.

---

# User Interface Design

The default Laravel interface was replaced with a custom Product CRUD interface.

The application uses a **dark blue and purple visual design**.

## Design Features

- Dark gradient background
- Purple and blue accent colors
- Rounded cards
- Styled buttons
- Responsive layout
- Product table
- Edit and Delete buttons
- Success messages
- Form validation messages
- Hover effects
- Mobile-friendly layout

The Product List page uses a table-based layout for displaying product information.

The Add and Edit pages use styled forms for entering product information.

The design was added without changing the core CRUD functionality.

---

# CRUD Testing

The CRUD functionality was tested manually through the browser.

## Create Test

A test product was created with the following information:

```text
Product Name: Wireless Mouse
Quantity: 10
Price: 599
Description: A comfortable wireless mouse
```

The product successfully appeared in the Product List.

---

## Read Test

The created product was displayed correctly in the Product List page.

The system successfully retrieved the product from the MySQL database using Eloquent ORM.

---

## Update Test

The test product was edited.

The values were changed to:

```text
Quantity: 15
Price: 650
```

The updated information was successfully displayed in the Product List.

---

## Delete Test

The test product was deleted using the Delete button.

The application displayed a confirmation prompt before deletion.

After confirming, the product was successfully removed from the Product List.

---

# CRUD Test Result

| Operation | Result |
|---|---|
| Create | Successful |
| Read | Successful |
| Update | Successful |
| Delete | Successful |

All four CRUD operations were successfully tested.

---

# Running the Project

## 1. Start XAMPP

Start the following services from XAMPP:

```text
Apache
MySQL
```

---

## 2. Open the Project

Open the project folder in Visual Studio Code:

```text
laravel-crud-activity-2
```

---

## 3. Install Dependencies

If the project is being installed on another computer, install the Laravel dependencies using:

```bash
composer install
```

---

## 4. Configure the Environment

Create a `.env` file from `.env.example` if one does not already exist.

Configure the MySQL database:

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud
DB_USERNAME=root
DB_PASSWORD=
```

Make sure the `laravel_crud` database exists.

---

## 5. Generate Application Key

If setting up the project on a new computer and an application key does not already exist, run:

```bash
php artisan key:generate
```

---

## 6. Run Database Migrations

Run:

```bash
php artisan migrate
```

This creates the required Laravel tables and the `products` table.

---

## 7. Start the Laravel Development Server

Run:

```bash
php artisan serve
```

The Laravel development server will provide a local URL similar to:

```text
http://127.0.0.1:8000
```

Open the provided address in a web browser.

The Product CRUD module can be accessed at:

```text
http://127.0.0.1:8000/products
```

---

# Important Laravel Concepts

## CRUD

CRUD stands for:

```text
Create
Read
Update
Delete
```

These represent the four basic operations performed on stored data.

### Create

Create adds a new record to the database.

In this project, a new product is created through the Add New Product form.

### Read

Read retrieves and displays records from the database.

In this project, all products are displayed on the Product List page.

### Update

Update changes information that already exists in the database.

In this project, the Edit Product page is used to update product information.

### Delete

Delete removes a record from the database.

In this project, the Delete button removes a selected product.

---

# Eloquent ORM

Eloquent is Laravel's **Object-Relational Mapping (ORM)** system.

It allows the application to interact with database records using Laravel models instead of writing raw SQL for every database operation.

Examples used in this project include:

```php
Product::all();
```

```php
Product::create(...);
```

```php
$product->update(...);
```

```php
$product->delete();
```

These methods allow the Product model to perform database operations through Eloquent.

---

# MVC Architecture

MVC stands for:

```text
Model
View
Controller
```

## Model

The Model handles the application's data and database interaction.

Example:

```text
app/Models/Product.php
```

The Product model represents the products stored in the database.

---

## View

The View handles the application's user interface.

Examples:

```text
resources/views/products/index.blade.php
resources/views/products/create.blade.php
resources/views/products/edit.blade.php
```

These Blade files display the product information and forms.

---

## Controller

The Controller handles application requests and connects the Model with the Views.

Example:

```text
app/Http/Controllers/ProductController.php
```

The controller contains the methods responsible for the CRUD operations.

---

# Laravel Blade

Blade is Laravel's templating engine.

The project uses Blade to create dynamic HTML pages.

Examples of Blade syntax used in the project include:

```php
{{ $product->name }}
```

This displays the product name.

The project also uses loops such as:

```php
@foreach($products as $product)
```

Conditional statements such as:

```php
@if(session('success'))
```

And:

```php
@forelse($products as $product)
```

Blade allows PHP logic and Laravel functionality to be used inside HTML templates.

---

# CSRF Protection

The project uses Laravel's CSRF protection for forms.

The following directive is used:

```php
@csrf
```

CSRF stands for **Cross-Site Request Forgery**.

The CSRF token helps ensure that form requests are coming from the application's legitimate interface.

---

# HTTP Method Spoofing

HTML forms normally support the GET and POST methods.

Laravel provides method spoofing so that forms can represent other HTTP methods.

For updating a product:

```php
@method('PUT')
```

For deleting a product:

```php
@method('DELETE')
```

This allows Laravel to correctly identify update and delete requests.

---

# Mass Assignment

Mass assignment allows multiple model attributes to be assigned at once.

This project uses:

```php
protected $fillable = [
    'name',
    'qty',
    'price',
    'description'
];
```

The `$fillable` property specifies which attributes are allowed to be assigned through mass assignment.

For example:

```php
Product::create(
    $request->only('name', 'qty', 'price', 'description')
);
```

This helps prevent unwanted attributes from being assigned to the model.

---

# Route Resource

The project uses:

```php
Route::resource('products', ProductController::class);
```

This creates the standard Laravel CRUD routes for the ProductController.

Instead of manually defining every CRUD route, `Route::resource()` provides the standard route structure automatically.

---

# Product Retrieval

The project uses:

```php
Product::all();
```

to retrieve all product records.

For a specific product, the project uses:

```php
Product::findOrFail($id);
```

`findOrFail()` searches for a product using its ID.

If the product exists, it is returned.

If the product does not exist, Laravel automatically returns a 404 response.

---

# Validation

The ProductController validates user input before storing or updating information.

The validation includes:

```php
$request->validate([
    'name' => 'required|string|max:255',
    'qty' => 'required|integer|min:0',
    'price' => 'required|numeric|min:0',
]);
```

This ensures that:

- The product name is provided.
- The product name is a string.
- The product name does not exceed 255 characters.
- The quantity is provided.
- The quantity is an integer.
- The quantity cannot be negative.
- The price is provided.
- The price is numeric.
- The price cannot be negative.

---

# Success Messages

After successful CRUD operations, the controller redirects the user and sends a success message.

For example:

```php
return redirect()
    ->route('products.index')
    ->with('success', 'Product added successfully!');
```

The Blade view then displays the message using:

```php
@if(session('success'))
    {{ session('success') }}
@endif
```

This provides feedback to the user after completing an operation.

---

# Code Defense Guide

The following questions can be used when explaining or defending the project.

## 1. What is CRUD?

CRUD stands for **Create, Read, Update, and Delete**.

These are the four basic operations used to manage records in a database.

---

## 2. What is MVC?

MVC stands for **Model-View-Controller**.

The Model handles data, the View handles the user interface, and the Controller handles application logic and requests.

---

## 3. What is Eloquent ORM?

Eloquent is Laravel's Object-Relational Mapping system.

It allows developers to interact with database records through Laravel models.

---

## 4. What is the purpose of the Product model?

The Product model represents product records in the database and allows the application to interact with the `products` table using Eloquent ORM.

---

## 5. Why is `$fillable` used?

The `$fillable` property specifies which model attributes are allowed for mass assignment.

In this project, the allowed attributes are:

```text
name
qty
price
description
```

---

## 6. What is `Product::all()`?

`Product::all()` retrieves all product records from the database.

---

## 7. What is `Product::create()`?

`Product::create()` creates a new Product record in the database using the attributes supplied to it.

---

## 8. What does `findOrFail()` do?

`findOrFail()` searches for a record by its ID.

If the record cannot be found, Laravel automatically returns a 404 response.

---

## 9. What does `$product->update()` do?

It updates the selected product record with the new information provided.

---

## 10. What does `$product->delete()` do?

It deletes the selected product record from the database.

---

## 11. Why is `@csrf` used?

`@csrf` generates a CSRF token that helps protect forms against Cross-Site Request Forgery attacks.

---

## 12. Why is `@method('PUT')` used?

HTML forms normally support GET and POST methods.

Laravel's method spoofing allows a form to represent a PUT request for an update operation.

---

## 13. Why is `@method('DELETE')` used?

It allows an HTML form to represent a DELETE request when deleting a product.

---

## 14. What does `Route::resource()` do?

`Route::resource()` automatically creates the standard routes required for CRUD operations.

---

## 15. Why is validation important?

Validation prevents invalid information from being stored in the database and ensures that required fields contain acceptable values.

---

## 16. What is Blade?

Blade is Laravel's templating engine.

It allows PHP and Laravel functionality to be used inside HTML views.

---

## 17. What database does the project use?

The project uses **MySQL** with the database name:

```text
laravel_crud
```

---

## 18. What is the purpose of the migration?

The migration creates the `products` table and defines its columns.

The migration makes it possible to create the database structure using Laravel commands.

---

## 19. What is the purpose of the controller?

The controller receives requests, processes application logic, communicates with the Product model, and returns the appropriate view or redirect.

---

## 20. What is the purpose of the Blade views?

The Blade views provide the user interface for viewing, creating, and editing products.

---

# Git and GitHub

Git and GitHub were used to track and submit the development of the project.

The GitHub repository is:

**Kelixtine/laravel-crud-activity-2**

The project uses the `main` branch.

Development was committed and pushed to GitHub throughout the implementation process.

Major development stages included:

```text
Initial Laravel project setup
        ↓
Database configuration
        ↓
Product migration
        ↓
Product model
        ↓
Product controller
        ↓
CRUD routes
        ↓
Blade views
        ↓
CRUD testing
        ↓
UI design improvements
        ↓
Git commits and GitHub push
```

---

# Development Progress

The project was developed step-by-step.

## Step 1 — Laravel Project Setup

A Laravel 9 project was created and configured.

The Laravel development server was tested using:

```bash
php artisan serve
```

---

## Step 2 — Database Setup

A MySQL database named `laravel_crud` was created.

The Laravel `.env` configuration was updated to connect the application to the database.

---

## Step 3 — Product Model and Migration

The Product model and migration were generated using:

```bash
php artisan make:model Product -m
```

The migration was then configured with the Product fields.

---

## Step 4 — Database Migration

The database tables were created using:

```bash
php artisan migrate
```

---

## Step 5 — Product Controller

The resource controller was created using:

```bash
php artisan make:controller ProductController --resource
```

The controller was then configured with the CRUD methods.

---

## Step 6 — Routes

The Product resource route was added to:

```text
routes/web.php
```

using:

```php
Route::resource('products', ProductController::class);
```

---

## Step 7 — Blade Views

Three Blade views were created:

```text
index.blade.php
create.blade.php
edit.blade.php
```

These views provide the Product List, Add Product, and Edit Product interfaces.

---

## Step 8 — CRUD Testing

The Create, Read, Update, and Delete operations were tested through the browser.

All four operations worked successfully.

---

## Step 9 — Interface Improvements

The default simple interface was improved with a custom dark blue and purple design.

The three Blade views were updated while preserving the original CRUD functionality.

---

# Final CRUD Functionality

The completed application supports:

```text
                 PRODUCT MANAGEMENT
                         │
        ┌────────────────┼────────────────┐
        │                │                │
        ▼                ▼                ▼
      CREATE            READ            UPDATE
        │                │                │
        │                │                │
        └────────────────┼────────────────┘
                         │
                         ▼
                       DELETE
```

Users can add, view, edit, and delete products through the web interface.

All product information is stored in the MySQL database.

---

# Testing Summary

The final application was tested using a sample product.

### Sample Product

```text
Product Name: Wireless Mouse
Quantity: 10
Price: 599
Description: A comfortable wireless mouse
```

### Update Test

The sample product was changed to:

```text
Quantity: 15
Price: 650
```

### Delete Test

The updated sample product was successfully deleted.

### Final Result

```text
CREATE  → PASS
READ    → PASS
UPDATE  → PASS
DELETE  → PASS
```

---

# Conclusion

This activity successfully demonstrates the development of a functional **Product CRUD Web Application using Laravel**.

The project integrates:

- Laravel
- MVC architecture
- Blade templates
- Eloquent ORM
- Controllers
- Resource routes
- MySQL
- Database migrations
- Form validation
- CSRF protection
- HTTP method spoofing
- Git
- GitHub

The Product Management system successfully performs all four CRUD operations:

**Create, Read, Update, and Delete.**

The application was also customized with a dark blue and purple interface to improve its visual appearance and usability.

The project demonstrates how Laravel components work together to create a simple database-driven web application.

---

# Project Information

| Information | Details |
|---|---|
| Activity | Activity No. 2: Creating CRUD Modules in Laravel |
| Course | CCC181 — Web Systems and Technologies |
| Framework | Laravel 9.52.22 |
| Programming Language | PHP 8.0.30 |
| Database | MySQL |
| Database Name | laravel_crud |
| Frontend | Blade Templates / HTML / CSS |
| Architecture | MVC |
| ORM | Eloquent |
| Development Environment | XAMPP |
| Code Editor | Visual Studio Code |
| Version Control | Git |
| Repository | Kelixtine/laravel-crud-activity-2 |

---

# End of Project Documentation

**Laravel Product CRUD Web Application**

**Activity No. 2 — Creating CRUD Modules in Laravel**