<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class Patient extends Model
{
    public $table = 'patient';
    protected $primaryKey = 'PATIENT_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $date = Carbon::now()->format('Y');

            $a = 'PBAH-'.$date.'-';
            $model->PATIENT_ID = IdGenerator::generate(['table' => 'patient', 'field' => 'PATIENT_ID', 'length' => 15, 'prefix' =>$a]);
        });
    }
}
