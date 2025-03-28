<?php

namespace App\Models;

use PDO;

class Jobs
{
  private PDO $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function getAll(): array
  {
    $sql = "SELECT * FROM jobs";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
  }

  public function getById(int $id): array
  {
    try {
      // Запрос с JOIN для получения всех типов работы для вакансии
      $sql = "SELECT jobs.*, GROUP_CONCAT(job_type.name) AS job_types
                FROM jobs
                LEFT JOIN job_job_type ON jobs.id = job_job_type.job_id
                LEFT JOIN job_type ON job_job_type.job_type_id = job_type.id
                WHERE jobs.id = :id
                GROUP BY jobs.id";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        error_log("Работа с ID: " . $id . " не найдена");
        return [];
      }

      // Возвращаем результат, включая все типы работы
      return $result;
    } catch (\PDOException $e) {
      error_log("Ошибка базы данных в getById: " . $e->getMessage());
      return [];
    }
  }
}
