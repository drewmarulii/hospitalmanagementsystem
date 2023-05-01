<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class Payment extends Model
{
    public $table = 'payment';
    protected $primaryKey = 'PAYMENT_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $a = 'PY-'.date('ymd');
            $b = '-';
            $c = $a.$b;
            $model->PAYMENT_ID = IdGenerator::generate(['table' => 'payment', 'field' => 'PAYMENT_ID', 'length' => 14, 'prefix' =>$c]);
        });
    }
}
