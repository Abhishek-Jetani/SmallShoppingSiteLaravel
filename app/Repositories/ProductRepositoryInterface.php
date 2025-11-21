<?php

namespace App\Repositories;

use App\Models\Product;

/**
 * Repository Pattern - Interface
 * 
 * This interface defines the contract for Product data access operations.
 * It abstracts the data layer from the business logic, making the code
 * more maintainable and testable.
 */
interface ProductRepositoryInterface
{
    /**
     * Get all products with their category relationship
     */
    public function getAllWithCategory();

    /**
     * Get products filtered by category ID
     */
    public function getByCategoryId($categoryId);

    /**
     * Find a product by ID
     */
    public function findById($id);

    /**
     * Create a new product
     */
    public function create(array $data);

    /**
     * Update an existing product
     */
    public function update(Product $product, array $data);

    /**
     * Delete a product
     */
    public function delete($id);

    /**
     * Get products for DataTables
     */
    public function getForDataTables($categoryId = null);
}

