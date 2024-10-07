<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tunjaganPotonganModel extends Model
{
    use HasFactory;
    protected $table = 'settingSalary';
    protected $guarded = ['id'];
}
