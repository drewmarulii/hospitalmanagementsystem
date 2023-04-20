<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;


class Treceived extends Model
{
    public $table = 'treceived';

    protected $primaryKey = 'TRECEIVED_ID';
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $date = Carbon::now()->format('Y');

            $a = 'TR'.$date.'-';
            $model->TRECEIVED_ID = IdGenerator::generate(['table' => 'treceived', 'field' => 'TRECEIVED_ID', 'length' => 15, 'prefix' =>$a]);
        });
    }
}
