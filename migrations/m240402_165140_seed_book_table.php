<?php

use Faker\Factory;
use yii\db\Migration;

/**
 * Class m240402_165140_seed_book_table
 */
class m240402_165140_seed_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeBooks();
    }

    private function insertFakeBooks()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $this->insert(
                'book',
                [
                    'title' => $faker->title,
                    'page' => $faker->randomNumber(2),
                    'language' => $faker->languageCode,
                    'genre' => $faker->title,
                    'description' => $faker->text
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240402_165140_seed_book_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240402_165140_seed_book_table cannot be reverted.\n";

        return false;
    }
    */
}
