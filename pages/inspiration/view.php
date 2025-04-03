<?php
require_once "config/db.php";

use App\Controllers\InspirationController;
use App\Models\Inspiration;

$inspirationsModel = new Inspiration($conn);
$inspirationsController = new InspirationController($inspirationsModel);
$inspirations = $inspirationsController->getAll();

// foreach ($inspirations as $inspiration) {
//   dump($inspiration);
// }


?>

<?php $titleName = "Inspiration"; ?>
<?php require_once "./layout/header.php"; ?>
<?php require_once "./layout/nav.php"; ?>

<div class="container">
  <div class="inspiration">
    <!-- <div class="inspiration__grid">
      <a href="/inspiration/1" class="inspiration__item">
        <div class="inspiration__image">
          <img src="/assets/img/inspiration/inspiration-1.png" alt="Brand Visionaries 2024">
        </div>
        <div class="inspiration__info">
          <h3 class="inspiration__title">Brand Visionaries 2024</h3>
          <span class="inspiration__type">Digital Product</span>
        </div>
      </a>

      <a href="/inspiration/1" class="inspiration__item">
        <div class="inspiration__image">
          <img src="/assets/img/inspiration/inspiration-2.png" alt="Good Habit">
        </div>
        <div class="inspiration__info">
          <h3 class="inspiration__title">Good Habit</h3>
          <span class="inspiration__type">Agency</span>
        </div>
      </a>

      <a href="/inspiration/1" class="inspiration__item">
        <div class="inspiration__image">
          <img src="/assets/img/inspiration/inspiration-3.png" alt="Never Before Seen">
        </div>
        <div class="inspiration__info">
          <h3 class="inspiration__title">Never Before Seen</h3>
          <span class="inspiration__type">Agency</span>
        </div>
      </a>

      <a href="#" class="inspiration__item">
        <div class="inspiration__image">
          <img src="/assets/img/inspiration/inspiration-4.png" alt="Agora">
        </div>
        <div class="inspiration__info">
          <h3 class="inspiration__title">Agora</h3>
          <span class="inspiration__type">Digital Product</span>
        </div>
      </a>

    </div> -->

    <div class="inspiration__grid">
      <?php foreach ($inspirations as $inspiration): ?>
        <a href="/inspiration/<?= $inspiration['id']; ?>" class="inspiration__item">
          <div class="inspiration__image">
            <img src="<?= $inspiration['image']; ?>" alt="<?= $inspiration['title']; ?>">
          </div>
          <div class="inspiration__info">
            <h3 class="inspiration__title"><?= $inspiration['title']; ?></h3>
            <span class="inspiration__type"><?= $inspiration['company']; ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

  </div>
</div>

<?php require_once "./layout/footer.php"; ?>