<?php
namespace App\src\MaSPack\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    public $timestamps = false;
    public $incrementing = true;

    public function socialPackages()
    {
        return $this->belongsToMany(
            'App\src\MaSPack\Infrastructure\Persistence\Eloquent\SocialPackageModel',
            'employee_socialpackage',
            'idEmployee',
            'idSocialPackage'
        )->withPivot(
            'id',
            'startDate',
            'endDate',
            'amount'
        );
    }
}
