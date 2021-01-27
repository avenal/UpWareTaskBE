<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%element}}`.
 */
class m210120_161335_create_element_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%element}}', [
            'id' => $this->primaryKey(),
            'date_from' => $this->date(),
            'date_to' => $this->date(),
            'date_time' => $this->dateTime(),
            'currency_name' => $this->string(),
            'currency_value' => $this->float(),
            'tag' => $this->integer(),
            'consent' => $this->boolean()
        ]);
        $this->addForeignKey('FK_element_tag', '{{%element}}', 'tag', '{{%tag}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_element_tag', '{{%element}}');
        $this->dropTable('{{%element}}');
    }
}
