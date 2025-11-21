<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Singleton Pattern
 * 
 * This class implements the Singleton design pattern to ensure only one
 * instance of LoggerService exists throughout the application lifecycle.
 * This is useful for centralized logging, configuration management, or
 * any service that should maintain state across the application.
 * 
 * Usage: LoggerService::getInstance()->log('message');
 */
class LoggerService
{
    /**
     * The single instance of the class
     * @var LoggerService|null
     */
    private static $instance = null;

    /**
     * Log entries stored in memory
     * @var array
     */
    private $logs = [];

    /**
     * Private constructor to prevent direct instantiation
     * This is a key part of the Singleton pattern
     */
    private function __construct()
    {
        // Private constructor prevents external instantiation
    }

    /**
     * Prevent cloning of the instance
     */
    private function __clone()
    {
        // Prevent cloning
    }

    /**
     * Prevent unserialization of the instance
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * Get the single instance of LoggerService
     * This is the main method of the Singleton pattern
     * 
     * @return LoggerService
     */
    public static function getInstance(): LoggerService
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Log a message
     * 
     * @param string $message
     * @param string $level
     * @return void
     */
    public function log(string $message, string $level = 'info'): void
    {
        $logEntry = [
            'message' => $message,
            'level' => $level,
            'timestamp' => now()->toDateTimeString()
        ];

        // Store in memory
        $this->logs[] = $logEntry;

        // Also log to Laravel's log system
        Log::{$level}($message);
    }

    /**
     * Get all logs from memory
     * 
     * @return array
     */
    public function getLogs(): array
    {
        return $this->logs;
    }

    /**
     * Clear logs from memory
     * 
     * @return void
     */
    public function clearLogs(): void
    {
        $this->logs = [];
    }
}

