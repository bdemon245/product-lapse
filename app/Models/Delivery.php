<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasFile;
use App\Traits\HasProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory, HasFile, HasProducts, HasCreator;
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

}
