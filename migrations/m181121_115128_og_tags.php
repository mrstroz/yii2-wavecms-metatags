<?php

use yii\db\Migration;

/**
 * Class m181121_115128_og_tags
 */
class m181121_115128_og_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('meta_tags', 'og_type', $this->string());
        $this->addColumn('meta_tags', 'og_title', $this->string());
        $this->addColumn('meta_tags', 'og_description', $this->text());
        $this->addColumn('meta_tags', 'og_image', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181121_115128_og_tags cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_115128_og_tags cannot be reverted.\n";

        return false;
    }
    */
}
