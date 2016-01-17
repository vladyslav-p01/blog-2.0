<?php

use yii\db\Schema;
use yii\db\Migration;

class m160116_172549_email_confirm extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'confirm_key', $this->string()->unique());

    }

    public function down()
    {
        $this->dropColumn('user', 'confirm_key');
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
