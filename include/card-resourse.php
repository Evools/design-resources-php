<?php

require_once "config/db.php";

use App\Models\Resources;
use App\Controllers\ResourcesController;

$resourceModel = new Resources($conn);
$resourceController = new ResourcesController($resourceModel);
$resources = $resourceController->getAllResources();

?>

<?php foreach ($resources as $resource): ?>
    <div class="card">
        <a href="" target="_blank">
            <div class="card__content">
                <img class="card__content-img" src="<?= $resource['image']; ?>" alt="">
                <div class="card__content-info">
                    <h2 class="card__content-title">
                        <?= $resource['title']; ?>
                    </h2>
                    <p class="card__content-text">
                        <?= $resource['content']; ?>
                    </p>
                </div>
            </div>
            <div class="card__footer">
                <p class="card__footer-title"><?= $resource['category_name']; ?></p>
                <a class="card__footer-link" href="/">
                    <img src="./assets/img/icons/share.svg" alt="">
                </a>
            </div>
        </a>
    </div>
<?php endforeach ?>