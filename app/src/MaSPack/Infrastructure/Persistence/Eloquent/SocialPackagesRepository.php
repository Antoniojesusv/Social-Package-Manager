<?php

namespace App\src\MaSPack\Infrastructure\Persistence\Eloquent;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use App\src\MaSPack\Infrastructure\Persistence\Eloquent\SocialPackageModel;
use App\src\MaSPack\Domain\SocialPackage\SocialPackageEntity;

class SocialPackagesRepository implements SocialPackagesRepositoryInterface
{
    public function findAll(): array
    {
        $socialPackageCollectionEloquentEntity = SocialPackageModel::all();

        return $this->mapFromEloquentCollectionToSocialPackageCollectionEntity(
            $socialPackageCollectionEloquentEntity
        );
    }

    public function findOneById(int $id): ?SocialPackageEntity
    {
        $socialPackageEloquentEntity = $this->findByIdEloquentEntity($id);

        if (empty($socialPackageEloquentEntity)) {
            return $socialPackageEloquentEntity;
        }

        return $this->mapToSocialPackageEntity($socialPackageEloquentEntity);
    }

    public function delete($socialPackageEntity): void
    {
        $socialPackageEloquentEntity = $this->findByIdEloquentEntity($socialPackageEntity->id());

        $socialPackageEloquentEntity->delete();
    }

    public function save(SocialPackageEntity $socialPackageEntity): void
    {
        $socialPackageEloquentEntity = ($socialPackageEntity->hasExistingId())
            ? $this->findByIdEloquentEntity($socialPackageEntity->id())
            : $this->fetchEloquentEntity();

        $socialPackageMapped = $this->mapToEloquentEntity($socialPackageEloquentEntity, $socialPackageEntity);

        $this->saveEloquentEntity($socialPackageMapped);
    }

    private function fetchEloquentEntity(): SocialPackageModel
    {
        return new SocialPackageModel();
    }

    private function findByIdEloquentEntity(int $id)
    {
        return  SocialPackageModel::find($id);
    }

    private function saveEloquentEntity($socialPackageEloquentEntity): void
    {
        $socialPackageEloquentEntity->saveOrFail();
    }

    private function mapToEloquentEntity($socialPackageEloquentEntity, $socialPackageEntity)
    {
        $socialPackageEloquentEntity->name = $socialPackageEntity->name();
        $socialPackageEloquentEntity->description = $socialPackageEntity->description();
        $socialPackageEloquentEntity->startDate = $socialPackageEntity->startDate();
        $socialPackageEloquentEntity->endDate = $socialPackageEntity->endDate();
        $socialPackageEloquentEntity->amount = $socialPackageEntity->amount();
        return $socialPackageEloquentEntity;
    }

    private function mapToSocialPackageEntity($socialPackageEloquentEntity): SocialPackageEntity
    {
        return new SocialPackageEntity(
            $socialPackageEloquentEntity->name,
            $socialPackageEloquentEntity->startDate,
            $socialPackageEloquentEntity->endDate,
            $socialPackageEloquentEntity->amount,
            $socialPackageEloquentEntity->id,
            $socialPackageEloquentEntity->description
        );
    }

    private function mapFromEloquentCollectionToSocialPackageCollectionEntity(
        $socialPackageCollectionEloquentEntity
    ): array {
        $socialPackagesCollection = [];

        foreach ($socialPackageCollectionEloquentEntity as $socialPackageEntity) {
            $socialPackagesCollection[] = $this->mapToSocialPackageEntity($socialPackageEntity);
        }

        return $socialPackagesCollection;
    }

    public function subscribeEmployeeToSocialPackage(int $id, int $idEmployee, string $startDate, string $endDate, float $amount): void
    {
        $this->findByIdEloquentEntity($id)->employees()->attach($idEmployee, ['startDate' => $startDate, 'endDate' => $endDate, 'amount' => $amount]);
    }

    public function findSocialPackageSubscriptions(int $id): array
    {
        return $this->findByIdEloquentEntity($id)->employees();
    }
}
