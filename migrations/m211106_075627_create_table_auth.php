<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%auth}}`.
 */
class m211106_075627_create_table_auth extends Migration
{

    /** @var string  */
    protected $tableName = '{{%auth}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $collation = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $collation = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'user_id' => $this->bigInteger unsigned()->unsigned()->notNull(),
            'source' => $this->string(255)->notNull(),
            'source_id' => $this->string(255)->notNull(),
        ], $collation);


        // creates index for column `user_id`
        $this->createIndex(
            'fk-auth-user_id-user-id',
            $this->tableName,
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-auth-user_id-user-id',
            $this->tableName,
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );


    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-auth-user_id-user-id',
            '{{%auth}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'fk-auth-user_id-user-id',
            '{{%auth}}'
        );

        $this->dropTable($this->tableName);
    }
}
