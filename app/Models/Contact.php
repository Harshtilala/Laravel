<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = 'contact';

    protected $fillable = ['contact_no', 'email'];

    // In Contact model
    public function student()
    {
        return $this->hasOne(Student::class, 'contact_id', 'id');
    }
}
