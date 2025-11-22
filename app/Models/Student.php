<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    protected $table = 'student';

    protected $fillable = ['roll_number', 'name','contact_id'];

   public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}
