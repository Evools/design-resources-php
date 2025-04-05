<?php

namespace App\Repositories;

use PDO;
use App\Models\Category;

class CategoryRepository implements RepositoryInterface
{
  private PDO $conn;
  private Category $category;

  public function __construct(PDO $conn, Category $category)
  {
    $this->conn = $conn;
    $this->category = $category;
  }

  public function getAll(): array
  {
    return $this->category->getAll();
  }

  public function getById(int $id): array
  {
    $sql = "SELECT * FROM category WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
  }

  public function create(array $data): int
  {
    $sql = "INSERT INTO category (name, description) VALUES (:name, :description)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':name', $data['name']);
    $stmt->bindValue(':description', $data['description'] ?? null);
    $stmt->execute();
    return (int) $this->conn->lastInsertId();
  }

  public function update(int $id, array $data): bool
  {
    $sql = "UPDATE category SET name = :name, description = :description WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':name', $data['name']);
    $stmt->bindValue(':description', $data['description'] ?? null);
    return $stmt->execute();
  }

  public function delete(int $id): bool
  {
    $sql = "DELETE FROM category WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
