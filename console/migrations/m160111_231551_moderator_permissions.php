<?php

use yii\db\Schema;
use yii\db\Migration;

class m160111_231551_moderator_permissions extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // create category permission
        $createCategory = $auth->createPermission('createCategory');
        $createCategory->description = 'Create a category';
        $auth->add($createCategory);

        // update category permission
        $updateCategory = $auth->createPermission('updateCategory');
        $updateCategory->description = 'Update a category';
        $auth->add($updateCategory);

        // delete category permission
        $deleteCategory = $auth->createPermission('deleteCategory');
        $deleteCategory->description = 'Delete a category';
        $auth->add($deleteCategory);

        // create post permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // update post permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update a post';
        $auth->add($updatePost);

        // delete post permission
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Delete a post';
        $auth->add($deletePost);

        // create comment permission
        $createComment = $auth->createPermission('createComment');
        $createComment->description = 'Create a comment';
        $auth->add($createComment);

        // update comment permission
        $updateComment = $auth->createPermission('updateComment');
        $updateComment->description = 'Update a comment';
        $auth->add($updateComment);

        // delete comment permission
        $deleteComment = $auth->createPermission('deleteComment');
        $deleteComment->description = 'Delete a comment';
        $auth->add($deleteComment);

        // create admin role
        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);


        $updateUser = $auth->createPermission('updateUser');
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $auth->add($deleteUser);



        // initialize admin permissions
        $auth->addChild($moderator, $createCategory);
        $auth->addChild($moderator, $updateCategory);
        $auth->addChild($moderator, $deleteCategory);
        $auth->addChild($moderator, $createPost);
        $auth->addChild($moderator, $updatePost);
        $auth->addChild($moderator, $deletePost);
        $auth->addChild($moderator, $createComment);
        $auth->addChild($moderator, $updateComment);
        $auth->addChild($moderator, $deleteComment);

        $auth->addChild($moderator, $updateUser);
        $auth->addChild($moderator, $deleteUser);

        $auth->assign($moderator, 1);
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('createCategory'));
        $auth->remove($auth->getPermission('updateCategory'));
        $auth->remove($auth->getPermission('deleteCategory'));
        $auth->remove($auth->getPermission('createPost'));
        $auth->remove($auth->getPermission('updatePost'));
        $auth->remove($auth->getPermission('deletePost'));
        $auth->remove($auth->getPermission('createComment'));
        $auth->remove($auth->getPermission('updateComment'));
        $auth->remove($auth->getPermission('deleteComment'));
        $auth->remove($auth->getPermission('updateUser'));
        $auth->remove($auth->getPermission('deleteUser'));

        $auth->remove($auth->getRole('moderator'));
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
