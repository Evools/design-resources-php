<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/router.php';

get('/', 'pages/resources.php');

//jobs
get('/jobs', 'pages/jobs/view.php');
get('/jobs/$id', 'pages/jobs/inner.php');

//inspiration
get('/inspiration', 'pages/inspiration/view.php');
get('/inspiration/$id', 'pages/inspiration/inner.php');

//Sponsor
get('/sponsor', 'pages/sponsor.php');

any('/404', 'pages/404.php');
