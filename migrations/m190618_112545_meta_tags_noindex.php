<?php

use yii\db\Migration;

/**
 * Class m190618_112545_meta_tags_noindex
 */
class m190618_112545_meta_tags_noindex extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('meta_tags', 'noindex', $this->boolean());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('meta_tags', 'noindex');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190618_112545_meta_tags_noindex cannot be reverted.\n";

        return false;
    }
    */
}
