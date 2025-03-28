<?php

namespace App\Models;

use PDO;

class Resources
{

  private PDO $conn;

  public function __construct(PDO $db)
  {
    $this->conn = $db;
  }

  public function getAll(): array
  {
    $sql = "SELECT resources.*, category.name AS category_name 
            FROM resources
            JOIN category ON resources.category_id = category.id";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
