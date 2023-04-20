<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class Medicine extends Model
{
    public $table = 'medicine';

    protected $primaryKey = 'MEDICINE_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $a = 'MDC-';
            $model->MEDICINE_ID = IdGenerator::generate(['table' => 'medicine', 'field' => 'MEDICINE_ID', 'length' => 9, 'prefix' =>$a]);
        });
    }
}
