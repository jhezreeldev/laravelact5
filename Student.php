<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // O Model kung ito ang ginamit mo

class Student extends Authenticatable // O extends Model
{
    use HasFactory;

    // KINAKAILANGAN ITO: I-define ang tamang primary key
    protected $primaryKey = 'student_id'; 
    
    // Tiyakin na ang tamang table name ang ginagamit kung iba sa 'students'
    // protected $table = 'students'; 

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'college',
        'program',
        'password', // kung ito ay kasama sa fillable
    ];
    
    // ... (iba pang properties tulad ng $hidden)
}
