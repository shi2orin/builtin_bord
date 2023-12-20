<?php

namespace App\Models\ActionLogs;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    protected $table = 'action_logs';

    protected $fillable = [
        'user_id',
        'post_id',
        'event_at',
    ];
    public function post()
    {
        return $this->belongTo('App\Models\Posts\Post');
    }
    public function user()
    {
        return $this->belongTo('App\Models\Users\User');
    }

    public function viewCounts($post_id)
    {
        return ActionLog::where('post_id', $post_id)->get()->count();
    }
}
