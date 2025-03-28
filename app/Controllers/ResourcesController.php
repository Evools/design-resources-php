<?php

namespace App\Controllers;

use App\Models\Resources;

class ResourcesController
{
  private Resources $resources;
  public function __construct(Resources $resources)
  {
    $this->resources = $resources;
  }

  public function getAllResources(): array
  {
    return $this->resources->getAll();
  }
}
