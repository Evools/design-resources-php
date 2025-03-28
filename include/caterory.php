<?php

require_once "config/db.php";

use App\Models\Category;
use App\Controllers\CategoryController;

$categoryModel = new Category($conn);
$categoryController = new CategoryController($categoryModel);

$categories = $categoryController->getAllCategories();

?>

<div class="category container">
    <ul class="category-list">
        <?php foreach ($categories as $row): ?>
            <li class="category-item">
                <a class="category-link" href="<?= $row['slug'] ?>"><?= $row['name']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>