<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Catalog extends Model
{
    //use SoftDeletes;

    public $table = 'catalogs';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'typeName',
        'value',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function collectors()
    {
        return $this->belongsToMany(Collector::class);
    }

/*     public function clients()
    {
        return $this->belongsToMany(Client::class);
    } */

/*     public function catalogs()
    {
        return $this->belongsToMany(Client::class);
    } */
}