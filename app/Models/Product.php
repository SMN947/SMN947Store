<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'productName',
        'category_id',
        'productBuyPrice',
        'productSellPrice',
        'productUnit',
        'productStock',
        'productMinStock',
        'productDescription'
    ];
}
