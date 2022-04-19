<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //Change Table Properties
    protected $table      = 'task';
    protected $primaryKey = 'id';
    public $timestamps    = false;
}
