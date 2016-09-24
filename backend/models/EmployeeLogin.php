<?php
namespace backend\models;

use yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class EmployeeLogin extends ActiveRecord implements IdentityInterface
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
    public $username;
	public $password;
	public $rememberMe = true;
	private $_user;  

	public static function tableName()
	{
		return 'employee_login';
	}

	public function behaviors()
	{
		return [
			TimestampBehavior::className()
		];
	}

	public function rules()
	{
		return [
            [['username', 'password'], 'required'],
			['rememberMe', 'boolean'],
			['password', 'validatePasswordOnLogin'],
			['status', 'default', 'value' => self::STATUS_ACTIVE],
			['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
		];
	}

    public function validatePasswordOnLogin($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect username or password');
			}
		}
	}

    public function login() {
		if ($this->validate()) {
			return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
		} else {
			return false;
		}
	}

    protected function getUser() {
		if ($this->_user === null) {
			$this->_user = EmployeeLogin::findByUsername($this->username);
		}
		return $this->_user;
	}

	public static function findIdentity($id)
	{
		return static::findOne(['id'=>$id, 'status'=> self::STATUS_ACTIVE]);
	}

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
	}

 	public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
