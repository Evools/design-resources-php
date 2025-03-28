<?php

namespace App\Controllers;

use App\Models\Jobs;

class JobsController
{
  private Jobs $jobs;

  public function __construct(Jobs $jobs)
  {
    $this->jobs = $jobs;
  }

  public function getAllJobs(): array
  {
    return $this->jobs->getAll();
  }

  public function getById(int $id): array
  {
    return $this->jobs->getById($id);
  }
}
