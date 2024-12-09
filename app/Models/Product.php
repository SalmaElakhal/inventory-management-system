<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $appends = ['product_image', 'text'];
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    //Methods
    public function getProductImageAttribute(){
        return asset('storage/product_images/'. $this->image);
    }
    
    public function getTextAttribute(){
        return $this->name;
    }
    //relations
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }



    public function sizeStocks()
    {
        return $this->hasMany(ProductSizeStock::class);
    }

    public function product_stocks()
{
    return $this->hasMany(ProductSizeStock::class);
}

public function product_stock()
{
    return $this->hasMany(ProductSizeStock::class);
}

}
