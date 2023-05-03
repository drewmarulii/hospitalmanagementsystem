<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Appointment extends Model
{
    public $table = 'appointments';
    protected $primaryKey = 'APPOINTMENT_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $a = 'AP-'.date('ymd');
            $b = '-';
            $c = $a.$b;
            $model->APPOINTMENT_ID = IdGenerator::generate(['table' => 'appointments', 'field' => 'APPOINTMENT_ID', 'length' => 16, 'prefix' =>$c]);
        });
    }
}


