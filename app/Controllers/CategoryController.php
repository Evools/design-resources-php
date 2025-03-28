<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategories(): array
    {
        return $this->category->getAll();
    }
}
