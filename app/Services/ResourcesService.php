<?php

namespace App\Services;

use App\Repositories\ResourcesRepository;

class ResourcesService
{
  private ResourcesRepository $repository;

  public function __construct(ResourcesRepository $repository)
  {
    $this->repository = $repository;
  }

  public function getAllResources(): array
  {
    return $this->repository->getAll();
  }

  public function getResourceById(int $id): array
  {
    $resource = $this->repository->getById($id);
    if (empty($resource)) {
      throw new \RuntimeException('Ресурс не найден');
    }
    return $resource;
  }

  public function getResourcesByCategory(int $categoryId): array
  {
    return $this->repository->getByCategory($categoryId);
  }

  public function createResource(array $data): int
  {
    $this->validateResourceData($data);
    return $this->repository->create($data);
  }

  public function updateResource(int $id, array $data): bool
  {
    $this->validateResourceData($data);
    if (!$this->repository->getById($id)) {
      throw new \RuntimeException('Ресурс не найден');
    }
    return $this->repository->update($id, $data);
  }

  public function deleteResource(int $id): bool
  {
    if (!$this->repository->getById($id)) {
      throw new \RuntimeException('Ресурс не найден');
    }
    return $this->repository->delete($id);
  }

  private function validateResourceData(array $data): void
  {
    if (empty($data['title'])) {
      throw new \InvalidArgumentException('Название ресурса обязательно');
    }
    if (strlen($data['title']) > 255) {
      throw new \InvalidArgumentException('Название ресурса слишком длинное');
    }
    if (empty($data['description'])) {
      throw new \InvalidArgumentException('Описание ресурса обязательно');
    }
    if (empty($data['url'])) {
      throw new \InvalidArgumentException('URL ресурса обязателен');
    }
    if (!filter_var($data['url'], FILTER_VALIDATE_URL)) {
      throw new \InvalidArgumentException('Некорректный URL ресурса');
    }
    if (empty($data['category_id'])) {
      throw new \InvalidArgumentException('Категория ресурса обязательна');
    }
  }
}
