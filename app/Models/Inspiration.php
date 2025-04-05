<?php

namespace App\Models;

use PDO;

class Inspiration
{
  private PDO $conn;

  public function __construct(PDO $db)
  {
    $this->conn = $db;
  }

  public function getAll(): array
  {
    $sql = "SELECT * FROM inspiration";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById(int $id): array
  {
    $sql = "SELECT * FROM inspiration WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
