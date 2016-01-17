<?php

use yii\db\Schema;
use yii\db\Migration;

class m160102_161502_post extends Migration
{
    public function up()
    {
        $this->createTable('post', [
            'id_post' => $this->primaryKey(),
            'title' => $this->string(30)->notNull(),
            'body' => $this->text()->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11),
            'author_id' => $this->integer(11),
            'deleted' => $this->smallInteger()->notNull()->defaultValue(false)
        ], Migration::$tableOptions);

        // author for post
        $this->addForeignKey(
            'FK-post-author_id',
            'post',
            'author_id',
            'user',
            'id'
        );

        $this->createTable('category', [
            'id_category' => $this->primaryKey(),
            'name' => $this->string(20),
            'deleted' => $this->smallInteger()->notNull()->defaultValue(false),
        ], Migration::$tableOptions);

        $this->createTable('category_post', [
            'category_id' => $this->integer(11),
            'post_id' => $this->integer(11),
        ]);

        $this->addForeignKey(
            'FK-category_post-category_id',
            'category_post',
            'category_id',
            'category',
            'id_category'
        );

        $this->addForeignKey(
            'FK-category_post-post_id',
            'category_post',
            'post_id',
            'post',
            'id_post'
        );

        $this->createTable('comment', [
            'id_comment' => $this->primaryKey(),
            'body' => $this->text()->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11),
            'author_id' => $this->integer(11),
            'post_id' => $this->integer(11),
        ], Migration::$tableOptions);

        //author for comment
        $this->addForeignKey(
            'FK-comment-author_id',
            'comment',
            'author_id',
            'user',
            'id'
        );



    }

    public function down()
    {
        $this->dropForeignKey('FK-post-author_id', 'post');

        $this->dropForeignKey('FK-category_post-category_id', 'category_post');
        $this->dropForeignKey('FK-category_post-post_id', 'category_post');
        $this->dropTable('category_post');
        $this->dropTable('category');
        $this->dropTable('post');

        $this->dropForeignKey('FK-comment-author_id', 'comment');
        $this->dropTable('comment');

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
