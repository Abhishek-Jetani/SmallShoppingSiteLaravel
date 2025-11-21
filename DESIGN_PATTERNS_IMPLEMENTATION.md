# Design Patterns Implementation Summary

This document describes where and how the three design patterns are implemented in this Laravel project.

## 1. Repository Pattern

**Purpose**: Abstracts data access logic from business logic, making code more maintainable and testable.

### Files:
- **Interface**: `app/Repositories/ProductRepositoryInterface.php`
- **Implementation**: `app/Repositories/ProductRepository.php`
- **Usage**: `app/Http/Controllers/AdminProductController.php`
- **Registration**: `app/Providers/AppServiceProvider.php` (register method)

### How it works:
- The `ProductRepositoryInterface` defines the contract for product data operations
- `ProductRepository` implements the interface with concrete database operations
- `AdminProductController` uses dependency injection to get the repository
- Laravel's service container automatically resolves the interface to the implementation

### Methods using Repository Pattern in AdminProductController:
- `index()` - Uses `getForDataTables()`
- `store()` - Uses `create()`
- `edit()` - Uses `findById()`
- `update()` - Uses `update()`
- `destroy()` - Uses `delete()`

---

## 2. Singleton Pattern

**Purpose**: Ensures only one instance of a class exists throughout the application lifecycle.

### Files:
- **Implementation**: `app/Services/LoggerService.php`
- **Usage**: `app/Observers/OrderObserver.php`

### How it works:
- `LoggerService` has a private constructor preventing direct instantiation
- `getInstance()` method ensures only one instance is created
- The instance is stored in a static property `$instance`
- Cloning and unserialization are prevented

### Usage Example:
```php
$logger = LoggerService::getInstance();
$logger->log("Message here", 'info');
```

### Where it's used:
- `OrderObserver` uses the singleton logger to log order events (created, updated, deleted)

---

## 3. Observer Pattern

**Purpose**: Allows objects to notify other objects about state changes without tight coupling.

### Files:
- **Observer**: `app/Observers/OrderObserver.php`
- **Registration**: `app/Providers/AppServiceProvider.php` (boot method)
- **Model**: `app/Models/Order.php`

### How it works:
- `OrderObserver` listens to Order model events automatically
- When an Order is created, updated, or deleted, the corresponding observer method is called
- The observer uses the Singleton LoggerService to log events
- Registered in `AppServiceProvider::boot()` using `Order::observe(OrderObserver::class)`

### Observer Methods:
- `created()` - Triggered when a new order is created
- `updated()` - Triggered when an order is updated
- `deleted()` - Triggered when an order is deleted

### Where it's triggered:
- Automatically when `Order::create()` is called in `app/Http/Controllers/OrderController.php`
- Automatically when `Order::update()` or `Order::delete()` is called anywhere in the application

---

## Pattern Locations Summary

| Pattern | Location | Files |
|---------|----------|-------|
| **Repository Pattern** | Controllers, Repositories | `app/Repositories/ProductRepositoryInterface.php`<br>`app/Repositories/ProductRepository.php`<br>`app/Http/Controllers/AdminProductController.php`<br>`app/Providers/AppServiceProvider.php` |
| **Singleton Pattern** | Services, Observers | `app/Services/LoggerService.php`<br>`app/Observers/OrderObserver.php` |
| **Observer Pattern** | Observers, Models, Providers | `app/Observers/OrderObserver.php`<br>`app/Models/Order.php`<br>`app/Providers/AppServiceProvider.php` |

---

## Testing the Patterns

### Repository Pattern:
- Create, update, or delete a product through the admin panel
- The controller uses the repository instead of direct model access

### Singleton Pattern:
- Check logs when orders are created/updated/deleted
- The same LoggerService instance is used throughout

### Observer Pattern:
- Create a new order through the order placement flow
- Check the logs - you should see observer-triggered log entries

