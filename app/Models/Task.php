<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['name', 'user_id', 'dueDate', 'finishedOn'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatedDueDate()
    {
        $dueDate = $this->attributes['dueDate'];
        return Carbon::parse($dueDate)->format('d/m/Y @ H:i');
    }

    public function getFormatedFinishingDate()
    {
        $finishingDate = $this->attributes['finishedOn'];

        if ($finishingDate) {
            return Carbon::parse($finishingDate)->format('d/m/Y @ H:i');
        }
    }

    public function isOverDue()
    {
        $dueDate = new Carbon($this->attributes['dueDate']);

        if ($dueDate->lt(Carbon::now()) && !$this->attributes['finishedOn']) {
            return true;
        }

        return false;
    }

    public function isPending()
    {
        $dueDate = new Carbon($this->attributes['dueDate']);

        if ($dueDate->gt(Carbon::now()) && !$this->attributes['finishedOn']) {
            return true;
        }

        return false;
    }

}
