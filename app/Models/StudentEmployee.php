<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentEmployee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'student_id',
        'name',
        'lastname',
        'middlename',
        'department_id',
    ];

    /**
     * Get the user account for this profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the department assigned to this profile.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
