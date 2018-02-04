<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'streams';

    protected $primaryKey = 'stream_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id', 'game', 'service', 'viewer_count',
    ];
}
