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
        'channel_id',
        'game',
        'service',
        'viewer_count',
        'twitch_stream_id',
        'is_current',
    ];

    /**
     * Скоуп по играм
     *
     * @param $query
     * @param $games
     * @return mixed
     */
    public function scopeGames($query, $games)
    {
        if (empty($games)) {
            return $query;
        }

        return $query->whereIn('game', $games);
    }

    /**
     * Скоуп по дате
     *
     * @param $query
     * @param $from
     * @param $to
     * @return mixed
     */
    public function scopeByDate($query, $from, $to)
    {
        if (empty($from) && empty($to)) {
            return $query->where('is_current', 1);
        }
        if ($from) {
            $query->where('created_at', '>', $from);
        }
        if ($to) {
            $query->where('created_at', '<', $to);
        }

        return $query;
    }
}
