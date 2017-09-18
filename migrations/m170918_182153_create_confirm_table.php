<?php

use yii\db\Migration;

/**
 * Handles the creation of table `confirm`.
 */
class m170918_182153_create_confirm_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('confirm', [
            'id' => $this->primaryKey(),
            'param' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'code' => $this->string()->notNull()->unique(),
            'url_correct' => $this->string()->notNull(),
            'url_invalid' => $this->string()->notNull(),
            'insert_date' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('confirm');
    }
}
