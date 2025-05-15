<?php

namespace App\Traits;

// trait NotificationTypes
// {
//     private const NOTIFICATION_TYPES = [
//         'SUCCESS' => 'success',
//         'ERROR' => 'error'
//     ];
// }

trait NotificationTypes
{
    private static $notificationTypes = [
        'SUCCESS' => 'success',
        'ERROR' => 'error'
    ];

    public static function getNotificationTypes()
    {
        return self::$notificationTypes;
    }
}
