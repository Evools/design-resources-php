<?php

namespace App\Repositories;

use PDO;
use App\Models\Jobs;

class JobsRepository implements RepositoryInterface
{
  private PDO $conn;
  private Jobs $jobs;

  public function __construct(PDO $conn, Jobs $jobs)
  {
    $this->conn = $conn;
    $this->jobs = $jobs;
  }

  public function getAll(): array
  {
    return $this->jobs->getAll();
  }

  public function getById(int $id): array
  {
    try {
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
      return $result ?: [];
    } catch (\PDOException $e) {
      error_log("Ошибка базы данных в getById: " . $e->getMessage());
      return [];
    }
  }

  public function create(array $data): int
  {
    try {
      $this->conn->beginTransaction();

      $sql = "INSERT INTO jobs (title, company, description, location, salary, created_at)
                    VALUES (:title, :company, :description, :location, :salary, NOW())";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':company', $data['company']);
      $stmt->bindValue(':description', $data['description']);
      $stmt->bindValue(':location', $data['location']);
      $stmt->bindValue(':salary', $data['salary'] ?? null);
      $stmt->execute();

      $jobId = (int) $this->conn->lastInsertId();

      if (!empty($data['job_types'])) {
        foreach ($data['job_types'] as $typeId) {
          $sql = "INSERT INTO job_job_type (job_id, job_type_id) VALUES (:job_id, :type_id)";
          $stmt = $this->conn->prepare($sql);
          $stmt->bindValue(':job_id', $jobId, PDO::PARAM_INT);
          $stmt->bindValue(':type_id', $typeId, PDO::PARAM_INT);
          $stmt->execute();
        }
      }

      $this->conn->commit();
      return $jobId;
    } catch (\Exception $e) {
      $this->conn->rollBack();
      error_log("Ошибка при создании вакансии: " . $e->getMessage());
      throw $e;
    }
  }

  public function update(int $id, array $data): bool
  {
    try {
      $this->conn->beginTransaction();

      $sql = "UPDATE jobs 
                    SET title = :title,
                        company = :company,
                        description = :description,
                        location = :location,
                        salary = :salary
                    WHERE id = :id";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':company', $data['company']);
      $stmt->bindValue(':description', $data['description']);
      $stmt->bindValue(':location', $data['location']);
      $stmt->bindValue(':salary', $data['salary'] ?? null);
      $stmt->execute();

      if (isset($data['job_types'])) {
        $sql = "DELETE FROM job_job_type WHERE job_id = :job_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':job_id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($data['job_types'] as $typeId) {
          $sql = "INSERT INTO job_job_type (job_id, job_type_id) VALUES (:job_id, :type_id)";
          $stmt = $this->conn->prepare($sql);
          $stmt->bindValue(':job_id', $id, PDO::PARAM_INT);
          $stmt->bindValue(':type_id', $typeId, PDO::PARAM_INT);
          $stmt->execute();
        }
      }

      $this->conn->commit();
      return true;
    } catch (\Exception $e) {
      $this->conn->rollBack();
      error_log("Ошибка при обновлении вакансии: " . $e->getMessage());
      return false;
    }
  }

  public function delete(int $id): bool
  {
    try {
      $this->conn->beginTransaction();

      $sql = "DELETE FROM job_job_type WHERE job_id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $sql = "DELETE FROM jobs WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $this->conn->commit();
      return true;
    } catch (\Exception $e) {
      $this->conn->rollBack();
      error_log("Ошибка при удалении вакансии: " . $e->getMessage());
      return false;
    }
  }
}
