<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\LoggerService;

/**
 * Observer Pattern
 * 
 * This class implements the Observer design pattern to listen to Order model events.
 * The Observer pattern allows objects to notify other objects about state changes
 * without tight coupling. Laravel's built-in observer system uses this pattern.
 * 
 * This observer will be triggered automatically when Order model events occur:
 * - created: When a new order is created
 * - updated: When an order is updated
 * - deleted: When an order is deleted
 * 
 * Location: app/Observers/OrderObserver.php
 * Registered in: app/Providers/AppServiceProvider.php (boot method)
 */
class OrderObserver
{
    /**
     * Handle the Order "created" event.
     * This method is called automatically when a new order is created.
     * 
     * @param Order $order
     * @return void
     */
    public function created(Order $order): void
    {
        // Using Singleton Pattern - Get the single instance of LoggerService
        // This demonstrates how Singleton pattern ensures only one logger instance exists
        $logger = LoggerService::getInstance();
        $logger->log("New order created: Order ID {$order->id}, Invoice #{$order->invoice_number}, Total: \${$order->total_price}, User ID: {$order->user_id}", 'info');
    }

    /**
     * Handle the Order "updated" event.
     * This method is called automatically when an order is updated.
     * 
     * @param Order $order
     * @return void
     */
    public function updated(Order $order): void
    {
        // Using Singleton Pattern - Get the single instance of LoggerService
        $logger = LoggerService::getInstance();
        $logger->log("Order updated: Order ID {$order->id}, Invoice #{$order->invoice_number}", 'info');
    }

    /**
     * Handle the Order "deleted" event.
     * This method is called automatically when an order is deleted.
     * 
     * @param Order $order
     * @return void
     */
    public function deleted(Order $order): void
    {
        // Using Singleton Pattern - Get the single instance of LoggerService
        $logger = LoggerService::getInstance();
        $logger->log("Order deleted: Order ID {$order->id}, Invoice #{$order->invoice_number}", 'warning');
    }
}

