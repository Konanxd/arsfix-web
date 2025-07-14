<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $primaryKey = 'technicians_id';
    protected $keyType = 'string';

    protected $fillable = ['technicians_id', 'name_technicians', 'login_data'];
}
