<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessor extends Model
{
    //Table name
    protected $table = 'accessors';

    //Attributes created_at and updated_at
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'user_agent',
    ];

    /**
     * The attributes that are not want to be mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'id_link',
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
     * Get the Link that owns the Accessor.
     */
    public function link()
    {
        return $this->belongsTo('App\Models\Link', 'id_link');
    }
}
