<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Client extends Model
{
    //use SoftDeletes;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'alias',
        'goverment_ID',
        'company',
        'telephone_1',
        'telephone_2',
        'collector',
        'route',
        'status',
        'detailed_address',
        'GPS',
        'home',
        'url',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function catalogs()
    {
        return $this->hasOne(Catalog::class);
    }

    public function collectors()
    {
        return $this->hasOne(Collector::class);
    }
}