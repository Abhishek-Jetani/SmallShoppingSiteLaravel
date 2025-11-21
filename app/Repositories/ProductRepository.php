<?php

namespace App\Repositories;

use App\Models\Product;
use Yajra\DataTables\DataTables;

/**
 * Repository Pattern - Implementation
 * 
 * This class implements the ProductRepositoryInterface and provides
 * concrete database operations for Product model. This pattern centralizes
 * data access logic and makes it easier to swap implementations or add
 * caching layers in the future.
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get all products with their category relationship
     */
    public function getAllWithCategory()
    {
        return Product::with('category')->get();
    }

    /**
     * Get products filtered by category ID
     */
    public function getByCategoryId($categoryId)
    {
        return Product::with('category')->where('category_id', $categoryId)->get();
    }

    /**
     * Find a product by ID
     */
    public function findById($id)
    {
        return Product::with('category')->findOrFail($id);
    }

    /**
     * Create a new product
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * Update an existing product
     */
    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product->fresh();
    }

    /**
     * Delete a product
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    /**
     * Get products for DataTables
     */
    public function getForDataTables($categoryId = null)
    {
        $query = Product::with('category');
        
        if ($categoryId && $categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }
        
        return $query;
    }
}

