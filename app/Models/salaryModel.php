<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salaryModel extends Model
{
    use HasFactory;
    protected $table = 'salary';
    protected $guarded = ['id'];
}
