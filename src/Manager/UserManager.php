<?php

namespace App\Manager;

use App\Entity\UserEntity;
use App\SessionBlog\SessionBlog;
use Core\QueryBuilder\Delete;
use Core\QueryBuilder\Insert;
use Core\QueryBuilder\Manager;
use Core\QueryBuilder\Select;
use Core\QueryBuilder\Update;
use Exception;

final class UserManager extends UserEntity
{


    /**
     * @throws Exception
     */
    public function doPreRegistration(array $input): void
    {
        (new Manager())->queryExecute(
            new Insert('user', ['name', 'password', 'email', 'token', 'expiration_date']),
            [
                'name' => $input['name'],
                'password' => password_hash($input['password1'], PASSWORD_BCRYPT),
                'email' => $input['email'],
                'token' => bin2hex(random_bytes(32)),
                'expiration_date' => strtotime('1 hour')
            ]
        );

    }


    public static function userIsConnected(): bool
    {
        if (!empty(SessionBlog::get('name'))) {
            return true;
        }

        return false;

    }


    public static function userIsAdmin(): bool
    {
        if (self::userIsConnected() && SessionBlog::get('role') == 'admin') {
            return true;
        }

        return false;

    }


    public function getUserInfo($info): ?self
    {
        $dataUser = (new Manager())->fetch((
        new Select('user', ['*']))
            ->where('email = :email'), ['email' => $info]);
        if (empty($dataUser)) {
            return null;
        }

        return new UserManager($dataUser);

    }


    public function getAllUsers(): array
    {
        $data = (new Manager())->fetchAll(new Select('user', ['*']));
        $users = [];
        foreach ($data as $res) {
            $users[] = new UserManager($res);
        }

        return $users;

    }


    public function setUserAdmin($id): void
    {
        (new Manager())->queryExecute(
            (new Update('user'))
                ->set('user.role = "admin"')
                ->where('id = :id'),
            ['id' => $id[0]]
        );

    }


    public function setUserUser($id): void
    {
        (new Manager())->queryExecute(
            (new Update('user'))
                ->set('user.role = "user"')
                ->where('id = :id'),
            ['id' => $id[0]]
        );

    }


    public function deleteUser($id): void
    {
        (new Manager())->queryExecute(
            (new Delete('user'))
                ->where('id = :id'),
            ['id' => $id[0]]
        );

    }


    public function setUserValid($token): void
    {
        (new Manager())->queryExecute(
            (new Update('user'))
                ->set('user.validation = "valid"')
                ->where('token = :token'),
            ['token' => $token[0]]
        );

    }


    public function getUserByToken($token): ?self
    {
        $user = (new Manager())->fetch(
            (new Select('user', ['*']))
                ->where('token = :token'),
            ['token' => $token[0]]
        );
        if (empty($user)) {
            return null;
        }

        return new UserManager($user);

    }


    public function deleteUserByToken($token): void
    {
        (new Manager())->queryExecute(
            (new Delete('user'))
                ->where('token = :token'),
            ['token' => $token[0]]
        );

    }


    public function updateNewPassword(array $input, $id): void
    {
        (new Manager())->queryExecute(
            (new Update('user'))
                ->set('user.password = :password')
                ->where('id = :id'),
            [
                'password' => password_hash($input['password1'], PASSWORD_BCRYPT),
                'id' => $id[0]
            ]
        );

    }


}
