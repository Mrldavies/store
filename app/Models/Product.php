<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use VanOns\Laraberg\Traits\RendersContent;

class Product extends Model
{
    use HasFactory,
        RendersContent;

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'description',
        'long_description',
        'qty',
        'price',
    ];

    public function __construct()
    {
        $this->contentColumn = 'long_description';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
