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
            'param' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'code' => $this->string()->notNull()->unique(),
            'redirect' => $this->string()->notNull(),
            'insert_date' => $this->integer()
        ]);
        $this->addPrimaryKey('pk_confirm', 'confirm', ['param', 'value']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('confirm');
    }
}
