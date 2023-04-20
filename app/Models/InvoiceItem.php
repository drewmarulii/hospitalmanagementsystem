<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class InvoiceItem extends Model
{
    public $table = 'invoiceitem';
    protected $primaryKey = 'INVITEM_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $a = 'LN-'.date('ymd');
            $b = '-';
            $c = $a.$b;
            $model->INVITEM_ID = IdGenerator::generate(['table' => 'invoiceitem', 'field' => 'INVITEM_ID', 'length' => 14, 'prefix' =>$c]);
        });
    }
}
