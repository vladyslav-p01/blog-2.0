<?php

use yii\db\Schema;
use yii\db\Migration;

class m160111_231954_admin_permissions extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $auth->getRole('moderator'));

        $createUser = $auth->createPermission('createUser');
        $auth->add($createUser);
        $auth->addChild($admin, $createUser);

        $deleteHardUser = $auth->createPermission('deleteHardUser');
        $auth->add($deleteHardUser);
        $auth->addChild($admin, $deleteHardUser);

        $deleteHardPost = $auth->createPermission('deleteHardPost');
        $auth->add($deleteHardPost);
        $auth->addChild($admin, $deleteHardPost);

        $deleteHardCategory = $auth->createPermission('deleteHardCategory');
        $auth->add($deleteHardCategory);
        $auth->addChild($admin, $deleteHardCategory);

        $auth->assign($admin, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getPermission('createUser'));
        $auth->remove($auth->getPermission('deleteHardUser'));
        $auth->remove($auth->getPermission('deleteHardPost'));
        $auth->remove($auth->getPermission('deleteHardCategory'));

        $auth->remove($auth->getRole('admin'));
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
