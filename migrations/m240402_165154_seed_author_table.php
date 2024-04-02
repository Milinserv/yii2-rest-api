<?php

use Faker\Factory;
use yii\db\Migration;

/**
 * Class m240402_165154_seed_author_table
 */
class m240402_165154_seed_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeAuthors();
    }

    private function insertFakeAuthors()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $this->insert(
                'author',
                [
                    'name' => $faker->name,
                    'birth_year' => $faker->date,
                    'country' => $faker->city,
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240402_165154_seed_author_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240402_165154_seed_author_table cannot be reverted.\n";

        return false;
    }
    */
}
