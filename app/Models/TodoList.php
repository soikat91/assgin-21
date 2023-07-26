<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{   
    protected $fillable=['title','userId','description'];
    use HasFactory;
}
