<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\User;

class m160112_114951_add_admin_and_moder extends Migration
{
    public function up()
    {
        $this->insert('user',
            [
                'id' => 1,
                'username' => 'admin',
                'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
                'status' => User::STATUS_ACTIVE,
                'email' => 'admin@mail.ru',
                'auth_key' => Yii::$app->security->generateRandomString(),
            ]);

        $this->insert('user',
            [
                'id' => 2,
                'username' => 'moderator',
                'password_hash' => Yii::$app->security->generatePasswordHash('moderator'),
                'status' => User::STATUS_ACTIVE,
                'email' => 'moderator@mail.ru',
                'auth_key' => Yii::$app->security->generateRandomString(),
            ]);
    }

    public function down()
    {
        $this->delete('user', ['id' => 1]);
        $this->delete('user', ['id' => 2]);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
