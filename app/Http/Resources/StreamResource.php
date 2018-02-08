<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class StreamResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'channel_id'       => $this->channel_id,
            'game'             => $this->game,
            'service'          => $this->service,
            'viewer_count'     => $this->viewer_count,
            'twitch_stream_id' => $this->twitch_stream_id,
            'is_current'       => $this->is_current,
        ];
    }
}
