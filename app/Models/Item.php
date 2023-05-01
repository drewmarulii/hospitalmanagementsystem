<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Item extends Model
{
    public $table = 'item';
    protected $primaryKey = 'ITEM_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->ITEM_ID = IdGenerator::generate(['table' => 'item', 'field' => 'ITEM_ID', 'length' => 9, 'prefix' =>'ITM-']);
        });
    }
}
