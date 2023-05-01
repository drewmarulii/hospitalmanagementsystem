<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Tlist extends Model
{
    use HasFactory;
    public $table = 'treatmentlist';

    protected $primaryKey = 'TREATMENT_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->TREATMENT_ID = IdGenerator::generate(['table' => 'treatmentlist', 'field' => 'TREATMENT_ID', 'length' => 7, 'prefix' =>'TR_']);
        });
    }
}
