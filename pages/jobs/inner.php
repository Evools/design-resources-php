<?php

require_once "config/db.php";

use App\Models\Jobs;
use App\Controllers\JobsController;

$jobsModel = new Jobs($conn);
$jobsController = new JobsController($jobsModel);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
}
$job = $jobsController->getById($id);
$typesArray = explode(',', $job['job_types']);




?>

<?php $titleName = "Jobs"; ?>
<?php require_once __DIR__ . "/../../layout/header.php"; ?>
<?php require_once __DIR__ . "/../../layout/nav.php"; ?>

<div class="container">
  <div class="job-inner">
    <div class="job-inner__header">
      <img src="<?= $job['image'] ?>" alt="<?= $job['company'] ?>" class="job-inner__logo">
      <h1 class="job-inner__company"><?= $job['company'] ?></h1>
      <h2 class="job-inner__title"><?= $job['specialization'] ?></h2>

      <div class="job-inner__info">
        <div class="job-inner__location">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#7E7E7E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 11.892 4.402 13.13 5.5 14.5L12 22L18.5 14.5C19.598 13.13 20 11.892 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2Z" stroke="#7E7E7E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <?= $job['country'] ?>
        </div>
        <div class="job-inner__salary">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M12 2V22M17 5H9.5C8.57174 5 7.6815 5.36875 7.02513 6.02513C6.36875 6.6815 6 7.57174 6 8.5C6 9.42826 6.36875 10.3185 7.02513 10.9749C7.6815 11.6313 8.57174 12 9.5 12H14.5C15.4283 12 16.3185 12.3687 16.9749 13.0251C17.6313 13.6815 18 14.5717 18 15.5C18 16.4283 17.6313 17.3185 16.9749 17.9749C16.3185 18.6313 15.4283 19 14.5 19H6" stroke="#7E7E7E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <?= $job['salary'] ?>
        </div>
      </div>

      <div class="job-inner__tags">
        <?php foreach ($typesArray as $type): ?>
          <span class="job-inner__tag"><?= htmlspecialchars($type); ?></span>
        <?php endforeach; ?>
      </div>

      <a href="#" class="btn btn--primary job-inner__apply">Apply for this position</a>
    </div>

    <div class="job-inner__content">
      <div class="job-inner__about">
        <h3 class="job-inner__about-title">About WorkOS 🚀</h3>
        <p class="job-inner__about-text">
          WorkOS is a developer platform that helps make apps enterprise-ready. We build tools and services for developers to help them implement features like Single Sign-On, Directory Sync, Multi-Factor Auth, and Audit Logs. We're a fully-distributed team with employees across US and EU time zones. We're well-funded, having recently raised an $80M Series B. Our fast growing customer base includes thousands of rapidly growing SaaS companies like Webflow, Vercel, Brex, PlanetScale, Loom, and Drata.
        </p>
      </div>
      <div class="job-inner__about">
        <h3 class="job-inner__about-title">About the role 💭</h3>
        <p class="job-inner__about-text">
          We're looking for an experienced product designer who has experience
          designing complex, high-density user interfaces for developer tools and
          B2B enterprise products. We think in systems, are passionate about
          developer experience, and believe in making strategic decisions
          informed by customer feedback. You’ll be responsible for discovering,
          defining, and designing experiences that attract and engage developers
          specifically. We have a lot of exciting new products planned that you will
          lead from research through implementation.
        </p>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>