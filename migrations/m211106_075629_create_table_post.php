<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%post}}`.
 */
class m211106_075629_create_table_post extends Migration
{

    /** @var string  */
    protected $tableName = '{{%post}}';

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
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(255)->notNull(),
            'tel' => $this->string(30)->notNull(),
            'body' => $this->text()->notNull(),
            'date' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'is_read' => $this->tinyInteger(1)->defaultValue(0),
        ], $collation);


        $this->createIndex('id', $this->tableName, 'id', true);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('id', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
