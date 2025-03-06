<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Specify the fields that can be mass-assigned
    protected $fillable = ['name'];

    public function image()
    {
        return $this->hasOne(ItemImage::class);
    }
}
