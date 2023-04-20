<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class Invoice extends Model
{
    public $table = 'invoices';
    protected $primaryKey = 'INVOICE_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $a = 'INV-'.date('ymd');
            $b = '-';
            $c = $a.$b;
            $model->INVOICE_ID = IdGenerator::generate(['table' => 'invoices', 'field' => 'INVOICE_ID', 'length' => 15, 'prefix' =>$c]);
        });
    }
}
