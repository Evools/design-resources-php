<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
  private CategoryRepository $repository;

  public function __construct(CategoryRepository $repository)
  {
    $this->repository = $repository;
  }

  public function getAllCategories(): array
  {
    return $this->repository->getAll();
  }

  public function getCategoryById(int $id): array
  {
    $category = $this->repository->getById($id);
    if (empty($category)) {
      throw new \RuntimeException('Категория не найдена');
    }
    return $category;
  }

  public function createCategory(array $data): int
  {
    $this->validateCategoryData($data);
    return $this->repository->create($data);
  }

  public function updateCategory(int $id, array $data): bool
  {
    $this->validateCategoryData($data);
    if (!$this->repository->getById($id)) {
      throw new \RuntimeException('Категория не найдена');
    }
    return $this->repository->update($id, $data);
  }

  public function deleteCategory(int $id): bool
  {
    if (!$this->repository->getById($id)) {
      throw new \RuntimeException('Категория не найдена');
    }
    return $this->repository->delete($id);
  }

  private function validateCategoryData(array $data): void
  {
    if (empty($data['name'])) {
      throw new \InvalidArgumentException('Название категории обязательно');
    }
    if (strlen($data['name']) > 255) {
      throw new \InvalidArgumentException('Название категории слишком длинное');
    }
  }
}
