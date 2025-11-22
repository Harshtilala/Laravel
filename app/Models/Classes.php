<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'section', 'subject_id',];

    protected $casts = [
        'subject_id' => 'array',
    ];


    public function subject()
    {
        return $this->belongsTo(related: Subject::class);
    }
}
