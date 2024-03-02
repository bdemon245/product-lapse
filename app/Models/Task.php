<?php

namespace App\Models;

use App\Traits\CanSendNotifications;
use App\Traits\HasComments;
use App\Traits\HasCreator;
use App\Traits\HasFile;
use App\Traits\HasOwner;
use App\Traits\HasProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Task extends Model
{
    use HasFactory, HasFile, HasProducts, HasComments, HasCreator, HasOwner, CanSendNotifications;
    protected $guarded = [];

    protected $casts = [
        'choose_mvp' => 'boolean',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'invitation_products', 'task_id', 'product_id');
    }
}
