<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%user}}`.
 */
class m211106_075629_create_table_user extends Migration
{

    /** @var string  */
    protected $tableName = '{{%user}}';

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
            'username' => $this->string(100)->notNull(),
            'old_username' => $this->text(),
            'email' => $this->string(100)->notNull(),
            'old_email' => $this->text(),
            'avatar_path' => $this->string(255),
            'role' => $this->tinyInteger()->defaultValue(10),
            'password_hash' => $this->string(255),
            'auth_key' => $this->string(255),
            'register_token' => $this->string(255),
            'email_reset_token' => $this->string(255),
            'new_email_request' => $this->string(100)->notNull(),
            'password_reset_token' => $this->string(255),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $collation);


        $this->createIndex('id', $this->tableName, 'id', true);
        $this->createIndex('username', $this->tableName, ['username','email']);
        $this->createIndex('username_2', $this->tableName, ['username','email']);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('id', $this->tableName);
        $this->dropIndex('username', $this->tableName);
        $this->dropIndex('username_2', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
