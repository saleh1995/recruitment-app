<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_seeker_id',
        'job_listing_id',
        'letter',
        'cv',
    ];



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'employer_id' => 'integer',
        'job_listing_id' => 'integer',
        'letter' => 'string',
    ];


    //relations

    //this relation is to know the job seeker
    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }

    //this relation is to know the job listing
    public function jobListing()
    {
        return $this->belongsTo(User::class, 'job_listing_id');
    }
}
