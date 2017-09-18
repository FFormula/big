<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170918_173041_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id'       => $this->primaryKey(),
            'email'    => $this->string()->notNull()->unique(),
            'nickname' => $this->string()->notNull()->unique(),
            'social_uid'=>$this->string()->Null()->unique(),
            'passhash' => $this->string(),
            'authokey' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
