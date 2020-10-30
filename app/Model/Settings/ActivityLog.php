<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = "activity_logs";
    protected $fillable = ['action_type', 'request_url', 'os', 'os_version', 'browser', 'ip', 'function_to_hit', 'user_id', 'error_code', 'status_code', 'response_code', 'response_message'];
}
