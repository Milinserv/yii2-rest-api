<?php

namespace app\controllers;

use app\models\Book;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BookController extends ActiveController
{
    public $modelClass = 'app\models\Book';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['create']);
        return $actions;
    }

    public function actionIndex($search = null, $author = null): ActiveDataProvider
    {
        $query = Book::find();

        if (!empty($search)) {
            $query->where(['title' => $search]);
        }

        if (!empty($author)) {
            $query->andWhere(['author_id' => $author]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    /**
     * @throws InvalidConfigException
     */
    public function actionCreate(): Response
    {
        $model = new Book();
        $model->load(Yii::$app->request->getBodyParams(), '');

        if ($model->save()) {
            Yii::$app->response->setStatusCode(201);
            return $this->asJson($model);
        } else {
            return $this->asJson($model->getErrors());
        }
    }


    public function actionUpdate($id): Response
    {
        $model = Book::findOne($id);
        if (!$model) {
            return $this->asJson('Book not found');
        }

        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save()) {
            return $this->asJson($model);
        } else {
            return $this->asJson($model->getErrors());
        }
    }

    /**
     * @throws Throwable
     * @throws StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $model = Book::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Book not found');
        }

        $model->delete();

        Yii::$app->response->setStatusCode(204);
        return $this->asJson('Book deleted successfully');
    }

}
