<?php $titleName = "Inspiration"; ?>
<?php require_once "./layout/header.php"; ?>
<?php require_once "./layout/nav.php"; ?>

<div class="container">
  <div class="inspiration-inner">
    <div class="inspiration-inner__header">
      <h1 class="inspiration-inner__title">Brand Visionaries 2024</h1>
      <a href="#" class="btn btn-primary inspiration-inner__btn">
        Visit website
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
          <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </a>
    </div>

    <div class="inspiration-inner__image">
      <img src="/assets/img/inspiration/inspiration-1.png" alt="Geist Typeface">
    </div>

    <div class="inspiration-inner__content">
      <p class="inspiration-inner__description">
        Geist is a typeface made for developers and designers, embodying Vercel's design principles of simplicity, minimalism, and speed.
      </p>

      <div class="inspiration-inner__meta">
        <div class="inspiration-inner__meta-item">
          <span class="inspiration-inner__meta-label">Category</span>
          <span class="inspiration-inner__meta-value">Digital Product</span>
        </div>
        <div class="inspiration-inner__meta-item">
          <span class="inspiration-inner__meta-label">Published at</span>
          <span class="inspiration-inner__meta-value">31st March 2024</span>
        </div>
        <a href="#" class="inspiration-inner__meta-link">Broken Link?</a>
      </div>
    </div>
  </div>
</div>
<?php require_once "./layout/footer.php"; ?>