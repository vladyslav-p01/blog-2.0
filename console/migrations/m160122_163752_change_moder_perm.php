<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_163752_change_moder_perm extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $moderator = $auth->getRole('moderator');

        $updatePost = $auth->getPermission('updatePost');
        $deletePost = $auth->getPermission('deletePost');

        $auth->removeChild($moderator, $updatePost);
        $auth->removeChild($moderator, $deletePost);

        $notAdminRule = new common\rbac\notAdminRule();
        $auth->add($notAdminRule);

        $updateNotAdminPost = $auth->createPermission('updateNotAdminPost');
        $updateNotAdminPost->description = 'update post if not admin roles';
        $updateNotAdminPost->ruleName = $notAdminRule->name;
        $auth->add($updateNotAdminPost);
        $auth->addChild($updateNotAdminPost, $updatePost);

        $deleteNotAdminPost = $auth->createPermission('deleteNotAdminPost');
        $deleteNotAdminPost->description = 'delete post if not admin roles';
        $deleteNotAdminPost->ruleName = $notAdminRule->name;
        $auth->add($deleteNotAdminPost);
        $auth->addChild($deleteNotAdminPost, $deletePost);

        $auth->addChild($moderator, $updateNotAdminPost);
        $auth->addChild($moderator, $deleteNotAdminPost);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $moderator = $auth->getRole('moderator');

        $updateNotAdminPost = $auth->getPermission('updateNotAdminPost');
        $deleteNotAdminPost = $auth->getPermission('deleteNotAdminPost');

        $auth->removeChild($moderator, $updateNotAdminPost);
        $auth->removeChild($moderator, $deleteNotAdminPost);

        $auth->remove($updateNotAdminPost);
        $auth->remove($deleteNotAdminPost);

        $notAdminRule = $auth->getRule('notAdminRule');
        $auth->remove($notAdminRule);

        $updatePost = $auth->getPermission('updatePost');
        $deletePost = $auth->createPermission('deletePost');

        $auth->addChild($moderator, $updatePost);
        $auth->addChild($moderator, $deletePost);
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
