<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.01.16
 * Time: 16:33
 */

namespace backend\models;


use common\models\User;

class UserForm extends User {

    public $password;

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['username', 'email'], 'unique'],
            ['password', 'string'],
            ['status', 'in', 'range' => array_keys(User::$textOfStatus)],
        ];
    }


    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->validate()) {
            $this->status = $this->status !== '' ? $this->status : User::STATUS_UNCONFIRMED_EMAIL;
            $this->created_at = $this->isNewRecord ? time() : $this->created_at ;
            $this->updated_at = $this->isNewRecord ? null : time();
            if ($this->password) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
            }

            if (parent::save()) {
                return true;
            }
        }
        return false;
    }
}