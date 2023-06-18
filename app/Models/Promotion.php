<?php

namespace App\Models;

use App\Models\Promotion as ModelsPromotion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
    protected $fillable = [
        'title',
        'discount',
        'picture',
        'status'
    ];

    public function promotion()
        {
            return $this->hasMany(Promotion:: class, 'promo_id','id');
        }
}
