<?php $titleName = "Jobs"; ?>
<?php require_once "./layout/header.php"; ?>
<?php require_once "./layout/nav.php"; ?>

<div class="jobs container">
    <div class="jobs__content">
        <h2 class="jobs__content-title">Get design jobs straight to your inbox</h2>
        <p class="jobs__content-desc">Latest curated design opportunities from around the industry. Sent weekly.</p>
        <div class="jobs__content-subscribe">
            <input class="search" type="email" placeholder="Enter your email">
            <button class="btn btn--primary">Subscribe</button>
        </div>
    </div>
    <div class="jobs__listings">
        <!-- Контент будет загружен через JavaScript -->
        <div class="jobs__loading">Loading...</div>
    </div>
</div>

<script src="/assets/js/components/JobsList.js"></script>
<?php require_once "./layout/footer.php"; ?>