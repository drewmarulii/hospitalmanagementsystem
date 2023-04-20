<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;


class MedicalRecord extends Model
{
    public $table = 'medicalrecord';
    protected $primaryKey = 'RECORD_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $date = Carbon::now()->format('Y');

            $a = 'MR-'.$date.'-';
            $model->RECORD_ID = IdGenerator::generate(['table' => 'medicalrecord', 'field' => 'RECORD_ID', 'length' => 13, 'prefix' =>$a]);
        });
    }
}
