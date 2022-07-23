<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%chat}}`.
 */
class m211106_075628_create_table_chat extends Migration
{

    /** @var string  */
    protected $tableName = '{{%chat}}';

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
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(40)->notNull(),
            'text' => $this->string(1024)->notNull(),
            'ip' => $this->string(50),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'color' => $this->string(7),
        ], $collation);



    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
