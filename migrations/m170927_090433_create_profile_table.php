<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 */
class m170927_090433_create_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('profile', [
            'user_id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'birthday' => $this->date(),
            'gender' => $this->integer(),
            'country' => $this->string(),
            'city' => $this->string()
        ]);
        $this->addForeignKey(
            'FK_profile_user_user_id',
            'profile',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('profile');
    }
}
