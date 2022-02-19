<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Spend extends Model
{
    //use SoftDeletes;

    public $table = 'spends';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'spendAmount',
        'collector_id',
        'url',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function collectors()
    {
        return $this->hasOne(Collector::class);
    }

}