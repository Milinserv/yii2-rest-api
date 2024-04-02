<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m240402_160508_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'author_id' => $this->integer(),
            'page' => $this->integer(),
            'language' => $this->string(),
            'genre' => $this->string(),
            'description' => $this->string()
        ]);

        $this->createIndex(
            'idx-author_id',
            'book',
            'author_id'
        );

        $this->addForeignKey(
            'fk-author_id',
            'book',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
        $this->dropForeignKey(
            'author_id',
            'author'
        );
    }
}
