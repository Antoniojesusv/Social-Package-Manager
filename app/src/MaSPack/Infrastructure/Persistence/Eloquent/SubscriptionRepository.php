<?php

namespace App\src\MaSPack\Infrastructure\Persistence\Eloquent;

use App\src\MaSPack\Domain\Subscription\SubscriptionRepositoryInterface;
use App\src\MaSPack\Infrastructure\Persistence\Eloquent\SocialPackageModel;
use App\src\MaSPack\Domain\SocialPackage\SocialPackageEntity;
use App\src\MaSPack\Domain\Subscription\SubscriptionEntity;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    private function findModel(int $id): SocialPackageModel
    {
        return SocialPackageModel::find($id);
    }

    public function findAllById(int $id): array
    {
        $socialPackageEloquentEntity = $this->findModel($id);

        if (empty($socialPackageEloquentEntity)) {
            return $socialPackageEloquentEntity;
        }

        $employessCollection = $socialPackageEloquentEntity->employees()->orderBy('name')->get();

        if (empty($employessCollection)) {
            return $employessCollection;
        }

        return $this->mapToSocialSubscribeEntity($employessCollection);
    }

    private function mapToSocialSubscribeEntity($employessCollection): array
    {
        $subscribersCollection = [];

        foreach ($employessCollection as $row) {
            $subscribersCollection[] = new SubscriptionEntity(
                $row->name,
                $row->pivot->startDate,
                $row->pivot->endDate,
                $row->pivot->amount
            );
        }

        return $subscribersCollection;
    }
}
