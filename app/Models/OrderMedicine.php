<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class OrderMedicine extends Model
{
    public $table = 'ordermedicine';

    protected $primaryKey = 'MED_ORDER_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $date = Carbon::now()->format('Y');
            $a = 'ORD-'.$date.'-';
            $model->MED_ORDER_ID = IdGenerator::generate(['table' => 'ordermedicine', 'field' => 'MED_ORDER_ID', 'length' => 15, 'prefix' =>$a]);
        });
    }
}
