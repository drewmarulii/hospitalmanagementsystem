<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Roles extends Model
{
    public $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->role_id = IdGenerator::generate(['table' => 'roles', 'field' => 'role_id', 'length' => 4, 'prefix' =>'R']);
        });
    }
}
