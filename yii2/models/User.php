<?php
namespace app\models;

use Yii;
use yii\base\InvalidConfigException;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $role;

    /**
     *
     * @return array User information
     * @throws InvalidConfigException If no user information exists
     */
    public static function getUsers()
    {
        if (array_key_exists('users', Yii::$app->params)) {
            return Yii::$app->params['users'];
        } else {
            throw new InvalidConfigException('Πρέπει να θέσετε τις απαραίτητες παραμέτρους χρηστών.');
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $users = self::getUsers();
        return isset($users[$id]) ? new static($users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $users = self::getUsers();
        foreach ($users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $users = self::getUsers();
        foreach ($users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     *
     * @return boolean
     */
    public function is($role)
    {
        return $this->role === $role;
    }
}
