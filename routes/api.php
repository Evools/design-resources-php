<?php

use App\Http\JobsApi;
use App\Models\Jobs;

$jobsModel = new Jobs($conn);
$jobsApi = new JobsApi($jobsModel);

// Маршруты API
$request_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Разбираем URL
$path = parse_url($request_uri, PHP_URL_PATH);

// Маршрутизация
switch ($path) {
  case '/api/jobs':
    if ($method === 'GET') {
      $jobsApi->getJobs();
    } else {
      http_response_code(405);
      echo json_encode(['error' => 'Метод не поддерживается']);
    }
    break;

  case '/api/subscribe':
    if ($method === 'POST') {
      $jobsApi->subscribe();
    } else {
      http_response_code(405);
      echo json_encode(['error' => 'Метод не поддерживается']);
    }
    break;

  default:
    http_response_code(404);
    echo json_encode(['error' => 'Эндпоинт не найден']);
    break;
}
