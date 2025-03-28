<?php

require_once "config/db.php";

use App\Models\Jobs;
use App\Controllers\JobsController;

$jobsModel = new Jobs($conn);
$jobsController = new JobsController($jobsModel);
$jobs = $jobsController->getAllJobs();

use Carbon\Carbon;

?>

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
        <div class="jobs__header">
            <div class="jobs__header-left">
                <span>Company</span>
                <span>Position</span>
            </div>
            <span>Posted Date</span>
        </div>
        <?php foreach ($jobs as $job): ?>
            <a href="/jobs/<?= $job['id'] ?>" class="jobs__link">
                <div class="jobs__item">
                    <div class="jobs__item-company">
                        <div class="jobs__item-company-block">
                            <img src="<?= $job['image'] ?>" alt="<?= $job['company'] ?>">
                            <span class="company-name"><?= $job['company'] ?></span>
                        </div>
                        <div class="jobs__item-info">
                            <h3><?= $job['specialization'] ?></h3>
                            <div class="jobs__item-details">
                                <span class="location"><?= $job['country'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="jobs__item-date"><?= Carbon::parse($job['created_at'])->diffForHumans(); ?></div>
                </div>
            </a>
        <?php endforeach; ?>

    </div>
</div>

<?php require_once "./layout/footer.php"; ?>