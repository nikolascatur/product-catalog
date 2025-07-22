<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProductVariant extends Model
{
    use HasUuids;

    protected $fillable = ['product_id', 'name_variant', 'weight', 'selling_price', 'base_price', 'product_stock', 'barcode'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
