<?php

use yii\db\Migration;

/**
 * Class m171219_135106_metatags_table
 */
class m171219_135106_metatags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->createTable('{{%meta_tags}}', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'language' => $this->string(10),
            'model' => $this->string(),
            'model_id' => $this->integer(),
            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string()
        ]);

        $this->createIndex('model', '{{%meta_tags}}', 'model');
        $this->createIndex('model_id', '{{%meta_tags}}', 'model_id');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%meta_tags}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171219_135106_metatags_table cannot be reverted.\n";

        return false;
    }
    */
}
