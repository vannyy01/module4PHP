<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m171107_135013_create_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'frequency'=> $this->integer(8)->notNull()->defaultValue(0),
        ]);
        $this->createTable('news_tag_assn', [
            'news_id' => $this->integer(11)->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('', 'news_tag_assn', ['news_id', 'tag_id']);
    }

}
