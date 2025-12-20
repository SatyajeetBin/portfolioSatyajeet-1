<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'module_permission';

    protected $fillable = [
        'role_id',
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
    protected static $logName = 'module_permission';

    public static function checkCRUDPermissionToUser($moduleName, $permissionType)
    {
        $loggedInUser = Auth::user();

        // Super admin has all permissions
        if ($loggedInUser->role_id == 1) {
            return true;
        }

        // Check user-specific permission
        $userPermission = UserPermission::where('user_id', $loggedInUser->id)
            ->where('module', $moduleName)
            ->value($permissionType);

        // Check role-based permission
        $rolePermission = Permission::where('role_id', $loggedInUser->role_id)
            ->where('module', $moduleName)
            ->value($permissionType);

        // Return true if either is "on", 1, or truthy
        return ($userPermission === 'on' || $userPermission == 1 || $userPermission === true)
            || ($rolePermission === 'on' || $rolePermission == 1 || $rolePermission === true);
    }


    public static function isSuperAdmin()
    {
        $loggedInUser = Auth::user();
        $isSuper = 0;
        if ($loggedInUser->role_id == 1) {
            $isSuper = 1;
        }
        return $isSuper;
    }

    public function getActivitylogOptions(): LogOptions
    {
        $userName = Auth::user()->first_last_name;

        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('Permission')
            ->setDescriptionForEvent(function (string $eventName) use ($userName) {
                return "{$userName} has {$eventName} Permission";
            });
    }
}
