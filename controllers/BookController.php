<?php

namespace app\controllers;

use yii\rest\ActiveController;

class BookController extends ActiveController
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }

}
