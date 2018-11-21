<?php

use yii\db\Migration;

/**
 * Class m181121_125258_meta_tags_rename
 */
class m181121_125258_meta_tags_rename extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameColumn('meta_tags','title','meta_title');
        $this->renameColumn('meta_tags','description','meta_description');
        $this->renameColumn('meta_tags','keywords','meta_keywords');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181121_125258_meta_tags_rename cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_125258_meta_tags_rename cannot be reverted.\n";

        return false;
    }
    */
}
