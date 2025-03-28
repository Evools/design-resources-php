<?php

namespace App\Services;

use App\Repositories\JobsRepository;

class JobsService
{
  private JobsRepository $repository;

  public function __construct(JobsRepository $repository)
  {
    $this->repository = $repository;
  }

  public function getAllJobs(): array
  {
    return $this->repository->getAll();
  }

  public function getJobById(int $id): array
  {
    $job = $this->repository->getById($id);
    if (empty($job)) {
      throw new \RuntimeException('Вакансия не найдена');
    }
    return $job;
  }

  public function createJob(array $data): int
  {
    $this->validateJobData($data);
    return $this->repository->create($data);
  }

  public function updateJob(int $id, array $data): bool
  {
    $this->validateJobData($data);
    if (!$this->repository->getById($id)) {
      throw new \RuntimeException('Вакансия не найдена');
    }
    return $this->repository->update($id, $data);
  }

  public function deleteJob(int $id): bool
  {
    if (!$this->repository->getById($id)) {
      throw new \RuntimeException('Вакансия не найдена');
    }
    return $this->repository->delete($id);
  }

  private function validateJobData(array $data): void
  {
    if (empty($data['title'])) {
      throw new \InvalidArgumentException('Название вакансии обязательно');
    }
    if (strlen($data['title']) > 255) {
      throw new \InvalidArgumentException('Название вакансии слишком длинное');
    }
    if (empty($data['company'])) {
      throw new \InvalidArgumentException('Название компании обязательно');
    }
    if (empty($data['description'])) {
      throw new \InvalidArgumentException('Описание вакансии обязательно');
    }
    if (empty($data['location'])) {
      throw new \InvalidArgumentException('Местоположение обязательно');
    }
  }
}
