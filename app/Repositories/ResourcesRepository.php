<?php

namespace App\Repositories;

use PDO;
use App\Models\Resources;

class ResourcesRepository implements RepositoryInterface
{
  private PDO $conn;
  private Resources $resources;

  public function __construct(PDO $conn, Resources $resources)
  {
    $this->conn = $conn;
    $this->resources = $resources;
  }

  public function getAll(): array
  {
    try {
      $sql = "SELECT resources.*, category.name as category_name
                    FROM resources
                    LEFT JOIN category ON resources.category_id = category.id
                    ORDER BY resources.created_at DESC";

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (\PDOException $e) {
      error_log("Ошибка при получении ресурсов: " . $e->getMessage());
      return [];
    }
  }

  public function getById(int $id): array
  {
    try {
      $sql = "SELECT resources.*, category.name as category_name
                    FROM resources
                    LEFT JOIN category ON resources.category_id = category.id
                    WHERE resources.id = :id";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result ?: [];
    } catch (\PDOException $e) {
      error_log("Ошибка при получении ресурса: " . $e->getMessage());
      return [];
    }
  }

  public function create(array $data): int
  {
    try {
      $sql = "INSERT INTO resources (title, description, url, image_url, category_id, created_at)
                    VALUES (:title, :description, :url, :image_url, :category_id, NOW())";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':description', $data['description']);
      $stmt->bindValue(':url', $data['url']);
      $stmt->bindValue(':image_url', $data['image_url'] ?? null);
      $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
      $stmt->execute();

      return (int) $this->conn->lastInsertId();
    } catch (\Exception $e) {
      error_log("Ошибка при создании ресурса: " . $e->getMessage());
      throw $e;
    }
  }

  public function update(int $id, array $data): bool
  {
    try {
      $sql = "UPDATE resources
                    SET title = :title,
                        description = :description,
                        url = :url,
                        image_url = :image_url,
                        category_id = :category_id
                    WHERE id = :id";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':description', $data['description']);
      $stmt->bindValue(':url', $data['url']);
      $stmt->bindValue(':image_url', $data['image_url'] ?? null);
      $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);

      return $stmt->execute();
    } catch (\Exception $e) {
      error_log("Ошибка при обновлении ресурса: " . $e->getMessage());
      return false;
    }
  }

  public function delete(int $id): bool
  {
    try {
      $sql = "DELETE FROM resources WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
    } catch (\Exception $e) {
      error_log("Ошибка при удалении ресурса: " . $e->getMessage());
      return false;
    }
  }

  public function getByCategory(int $categoryId): array
  {
    try {
      $sql = "SELECT resources.*, category.name as category_name
                    FROM resources
                    LEFT JOIN category ON resources.category_id = category.id
                    WHERE resources.category_id = :category_id
                    ORDER BY resources.created_at DESC";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (\PDOException $e) {
      error_log("Ошибка при получении ресурсов по категории: " . $e->getMessage());
      return [];
    }
  }
}
