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

  // public function getAll(): array
  // {
  //   $sql = "SELECT * FROM ";
  // }
}