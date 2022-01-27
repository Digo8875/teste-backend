<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;

    //Table name
    protected $table = 'links';

    //Attributes created_at and updated_at
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'slug', 'accesses', 'id_user',
    ];

    /**
     * The attributes that are not want to be mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        '',
    ];

    /**
     * Get the User that owns the Link.
     */
    public function user()
    {
        return $this->belongsTo('App\Users', 'id_user');
    }

    /**
     * Get the Acessors for the Link.
     */
    public function accessors()
    {
        return $this->hasMany('App\Models\Accessor', 'id_link');
    }
}
