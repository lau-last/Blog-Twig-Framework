<?php

namespace App\Manager;

use Core\QueryBuilder\Manager;
use Core\Session\Session;

final class Notification
{


    public static function notificationInvalidComment(): string
    {
        return implode((new Manager())->fetch(
            (new \Core\QueryBuilder\Select('comment', ['COUNT(validation)']))
                ->where('validation = "invalid"')
        ));

    }


    public static function notificationValidComment(): string
    {
        return implode((new Manager())->fetch(
            (new \Core\QueryBuilder\Select('comment', ['COUNT(validation)']))
                ->where('validation = "valid"')
        ));

    }


    public static function notificationArticleManagement(): string
    {
        return implode(
            (new Manager())->fetch(
                (new \Core\QueryBuilder\Select('article', ['COUNT(*)']))
            )
        );

    }


    public static function notificationUserManagement(): string
    {
        return implode(
            (new Manager())->fetch(
                (new \Core\QueryBuilder\Select('user', ['COUNT(*)']))
            )
        );

    }


    public static function notificationConnection(): string
    {
        if ((new UserManager())->userIsConnected()) {
            return 'Connected';
        }

        return 'Offline';

    }


}
