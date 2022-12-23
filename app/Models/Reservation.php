<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['first_name','last_name', 'email', 'tel_number', 'res_date', 'table_id', 'guest_number'];


    protected $casts = [
        'res_date'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
