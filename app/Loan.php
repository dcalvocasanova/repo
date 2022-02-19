<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Loan extends Model
{
    //use SoftDeletes;

    public $table = 'loans';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'start_at',
        'amountRequested',
        'amountRemaining',
        'client_id',
        'interest_id',
        'period_id',
        'creditTerm_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function catalogs()
    {
        return $this->hasMany(Catalog::class);
    }

}