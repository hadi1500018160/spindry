<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    // protected $table = 'Service';  (jika nama table dengan istilah contoh : tb_namatable  wajib digunakan) $fillabel ()
    protected $fillable = [
        'logo',
         'title',
          'price',
           'description'
        ];

        public function order()
        {
            return $this->hasMany(Order:: class, 'service_id','id');
        }
}
