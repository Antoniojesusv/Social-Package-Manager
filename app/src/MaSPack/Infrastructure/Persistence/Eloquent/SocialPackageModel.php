<?php
namespace App\src\MaSPack\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialPackageModel extends Model
{
    use SoftDeletes;
    
    protected $table = 'socialpackages';
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    public $incrementing = true;

    public function employees()
    {
        return $this->belongsToMany(
            'App\src\MaSPack\Infrastructure\Persistence\Eloquent\EmployeeModel',
            'employee_socialpackage',
            'idSocialPackage',
            'idEmployee'
        )->withPivot(
            'id',
            'startDate',
            'endDate',
            'amount'
        );
    }
}
