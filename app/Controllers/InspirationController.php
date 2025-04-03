<?php

namespace App\Controllers;

use App\Models\Inspiration;

class InspirationController
{
  private Inspiration $inspiration;

  public function __construct(Inspiration $inspiration)
  {
    $this->inspiration = $inspiration;
  }

  public function getAll(): array
  {
    return $this->inspiration->getAll();
  }

  public function getById(int $id): array
  {
    return $this->inspiration->getById($id);
  }
}
