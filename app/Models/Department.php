<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'department_id',
        'college',
        'description',
    ];

    /**
     * Get the student/employee profiles assigned to this department.
     */
    public function studentEmployees(): HasMany
    {
        return $this->hasMany(StudentEmployee::class);
    }
}
