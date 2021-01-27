<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%element_tag}}`.
 */
class m210120_161724_create_element_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%element_tag}}', [
            'id' => $this->primaryKey(),
            'element_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);
        $this->addForeignKey('FK_element_tag_element_element_id', '{{%element_tag}}', 'element_id', '{{%element}}', 'id','CASCADE', 'CASCADE');
        $this->addForeignKey('FK_element_tag_tag_tag_id', '{{%element_tag}}', 'tag_id', '{{%tag}}', 'id','CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_element_tag_element_element_id', '{{%element_tag}}');
        $this->dropForeignKey('FK_element_tag_tag_tag_id', '{{%element_tag}}');
        $this->dropTable('{{%element_tag}}');
    }
}
