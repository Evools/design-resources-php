<?php

require_once "config/db.php";

use App\Controllers\InspirationController;
use App\Models\Inspiration;
use Carbon\Carbon;

$inspirationsModel = new Inspiration($conn);
$inspirationsController = new InspirationController($inspirationsModel);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
}

$inspiration = $inspirationsController->getById($id);

?>

<?php $titleName = "Inspiration"; ?>
<?php require_once "./layout/header.php"; ?>
<?php require_once "./layout/nav.php"; ?>

<div class="container">
  <div class="inspiration-inner">
    <div class="inspiration-inner__header">
      <h1 class="inspiration-inner__title"><?= $inspiration['title']; ?></h1>
      <a href="#" class="btn btn-primary inspiration-inner__btn">
        Visit website
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
          <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </a>
    </div>

    <div class="inspiration-inner__image">
      <img src="<?= $inspiration['image']; ?>" alt="Geist Typeface">
    </div>

    <div class="inspiration-inner__content">
      <p class="inspiration-inner__description">
        <?= $inspiration['content']; ?>
      </p>

      <div class="inspiration-inner__meta">
        <div class="inspiration-inner__meta-item">
          <span class="inspiration-inner__meta-label">Category</span>
          <span class="inspiration-inner__meta-value">Digital Product</span>
        </div>
        <div class="inspiration-inner__meta-item">
          <span class="inspiration-inner__meta-label">Published at</span>
          <span class="inspiration-inner__meta-value"><?= Carbon::parse(time: $inspiration['created_at'])->diffForHumans(); ?></span>
        </div>
        <a href="#" class="inspiration-inner__meta-link">Broken Link?</a>
      </div>
    </div>
  </div>
</div>
<?php require_once "./layout/footer.php"; ?>