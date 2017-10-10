<?php

use yii\db\Migration;

/**
 * Handles the creation of table `funnel`.
 */
class m171010_170532_create_funnel_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('funnel', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull()
        ]);
        $this->addForeignKey('fk_funnel_user_id_user_id',
            'funnel', 'user_id',
            'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('funnel');
    }
}
