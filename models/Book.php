<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int|null $author_id
 * @property int|null $page
 * @property string|null $language
 * @property string|null $genre
 * @property string|null $description
 *
 * @property Author $author
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book';
    }

    public function fields()
    {
        return [
            'title',
            'author_id',
            'page',
            'language',
            'genre',
            'description'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['author_id', 'page'], 'default', 'value' => null],
            [['author_id', 'page'], 'integer'],
            [['title', 'language', 'genre', 'description'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author_id' => 'Author ID',
            'page' => 'Page',
            'language' => 'Language',
            'genre' => 'Genre',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}
