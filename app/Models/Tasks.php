<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $fillable = ['project_id', 'name', 'members', 'tags', 'category', 'status', 'priority_level', 'start_date', 'end_date', 'added_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'members');
    }

}
