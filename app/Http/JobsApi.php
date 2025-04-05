<?php

namespace App\Http;

use App\Models\Jobs;
use App\Controllers\JobsController;

class JobsApi
{
  private Jobs $jobs;
  private JobsController $jobsController;

  public function __construct(Jobs $jobs)
  {
    $this->jobs = $jobs;
    $this->jobsController = new JobsController($jobs);
  }

  public function getJobs()
  {
    $page = $_GET['page'] ?? 1;
    $perPage = $_GET['per_page'] ?? 10;
    $offset = ($page - 1) * $perPage;

    try {
      $jobs = $this->jobs->getPaginated($offset, $perPage);
      $total = $this->jobs->getTotal();

      header('Content-Type: application/json');
      echo json_encode([
        'success' => true,
        'jobs' => $jobs,
        'total' => $total,
        'page' => (int)$page,
        'per_page' => (int)$perPage
      ]);
    } catch (\Exception $e) {
      http_response_code(500);
      echo json_encode([
        'success' => false,
        'error' => 'Ошибка при получении списка вакансий'
      ]);
    }
  }

  public function subscribe()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      echo json_encode(['success' => false, 'error' => 'Метод не поддерживается']);
      return;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      http_response_code(400);
      echo json_encode(['success' => false, 'error' => 'Некорректный email']);
      return;
    }

    try {
      // Здесь должна быть логика сохранения email в базу данных
      // и отправки подтверждения подписки

      header('Content-Type: application/json');
      echo json_encode(['success' => true, 'message' => 'Подписка оформлена успешно']);
    } catch (\Exception $e) {
      http_response_code(500);
      echo json_encode(['success' => false, 'error' => 'Ошибка при оформлении подписки']);
    }
  }
}
