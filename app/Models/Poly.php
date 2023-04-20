<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Poly extends Model
{
    // use HasFactory;
    public $table = 'polyclinic';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->poly_id = IdGenerator::generate(['table' => 'polyclinic', 'field' => 'poly_id', 'length' => 6, 'prefix' =>'PL-']);
        });
    }
}
