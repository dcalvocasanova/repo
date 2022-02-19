<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Payment extends Model
{
    //use SoftDeletes;

    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'paymentAmount',
        'loan_id',
        'paymentMethod_id',
        'url',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function catalogs()  //metodo de pago
    {
        return $this->hasOne(Catalog::class);
    }

   public function loans()  //credito
    {
        return $this->hasOne(Loan::class);
    }

}