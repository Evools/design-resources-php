<?php

$jobs_listings = [
    [
        "img" => "/assets/img/companies/workos.png",
        'company' => 'WorkOS',
        'title' => 'Experienced Product Designer',
        'location' => 'Remote',
        'date' => '270 days ago',
        "link" => "/jobs/1"
    ],
    [
        "img" => "/assets/img/companies/CoinTracker.png",
        'company' => 'CoinTracker',
        'title' => 'Staff Product Designer',
        'location' => 'Remote',
        'date' => '270 days ago',
        "link" => "/jobs/2"
    ],
    [
        "img" => "/assets/img/companies/Metalab.png",
        'company' => 'Metalab',
        'title' => 'Staff Product Designer',
        'location' => 'Remote',
        'date' => '270 days ago',
        "link" => "/jobs/3"
    ],
    [
        "img" => "/assets/img/companies/Speakeasy.png",
        'company' => 'Speakeasy',
        'title' => 'Staff Product Designer',
        'location' => 'Remote',
        'date' => '270 days ago',
        "link" => "/jobs/4"
    ],
    [
        "img" => "/assets/img/companies/CopilotMoney.png",
        'company' => 'Copilot Money',
        'title' => 'Staff Product Designer',
        'location' => 'Remote',
        'date' => '270 days ago',
        "link" => "/jobs/5"
    ]

]

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
        <?php foreach ($jobs_listings as $job): ?>
            <a href="<?= $job['link'] ?>" class="jobs__link">
                <div class="jobs__item">
                    <div class="jobs__item-company">
                        <div class="jobs__item-company-block">
                            <img src="<?= $job['img'] ?>" alt="WorkOS">
                            <span class="company-name"><?= $job['company'] ?></span>
                        </div>
                        <div class="jobs__item-info">
                            <h3><?= $job['title'] ?></h3>
                            <div class="jobs__item-details">
                                <span class="location"><?= $job['location'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="jobs__item-date">270 days ago</div>
                </div>
            </a>
        <?php endforeach; ?>

    </div>
</div>

<?php require_once "./layout/footer.php"; ?>