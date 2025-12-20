<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserPermission extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'user_permissions';

    protected $fillable = [
        'user_id',
        'module',
        'read',
        'create',
        'update',
        'delete'
    ];

    protected static $logAttributes = ['*'];
    protected static $logFillable = true;
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logUnguarded = true;
    protected static $logName = 'user_permissions';

    public function getActivitylogOptions(): LogOptions
    {
        $userName = Auth::user()->first_last_name;

        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('UserPermission')
            ->setDescriptionForEvent(function (string $eventName) use ($userName) {
                return "{$userName} has {$eventName} User Permission";
            });
    }
}