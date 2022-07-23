<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%content}}`.
 */
class m211106_075629_create_table_content extends Migration
{

    /** @var string  */
    protected $tableName = '{{%content}}';

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
            'page' => $this->string(255)->notNull(),
            'page_text' => $this->text()->notNull(),
            'title' => $this->string(255)->notNull(),
            'title_seo' => $this->string(255),
            'description' => $this->string(255),
            'last_mod' => $this->integer()->unsigned()->notNull(),
        ], $collation);


        $this->createIndex('page_2', $this->tableName, 'page', true);
        $this->createIndex('page', $this->tableName, 'page');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('page_2', $this->tableName);
        $this->dropIndex('page', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
