<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'location',
        'salary_from',
        'salary_to',
        'employemnt_type',
        'status',
        'posted_at',
    ];



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'employer_id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'location' => 'string',
        'salary_from' => 'float',
        'salary_to' => 'float',
        'employemnt_type' => 'integer',
        'status' => 'boolean',
        'posted_at' => 'datetime',
    ];


    //relations

    //this relation is to know which employer has posted this job
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
