<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'qty',
        'date_input',
        'type',
        'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
