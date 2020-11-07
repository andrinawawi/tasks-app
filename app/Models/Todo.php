<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $fillable = ['name'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
