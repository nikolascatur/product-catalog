<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model {
    use HasUuids;

    protected $fillable = ['name', 'category'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function productVariants() {
        return $this->hasMany(ProductVariant::class);
    }
}


