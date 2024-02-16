<?php

namespace App\Models;

use App\Traits\HasOwner;
use App\Traits\HasCreator;
use App\Traits\HasComments;
use App\Traits\HasProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Idea extends Model
{
    use HasFactory, HasProducts, HasComments, HasCreator, HasOwner, Notifiable;
    protected $guarded = [];
}
