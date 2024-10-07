<?php

namespace app\controllers;

use app\models\Product;
use yii\rest\ActiveController;
use Yii;
use yii\filters\Cors;

class ProductController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['http://localhost:4200'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Allow-Headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
                'Access-Control-Max-Age' => 3600,
            ],
        ];

        return $behaviors;
    }

    public $modelClass = 'app\models\Product';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete']);
        return $actions;
    }

    public function actionCategories()
    {
        return [
            ['id' => 1, 'name' => 'Esportes'],
            ['id' => 2, 'name' => 'Eletrônicos'],
            ['id' => 3, 'name' => 'Lazer'],
        ];
    }
    
    public function actionCreate()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $model;
        }
        
        return $model->getErrors();
    }

    public function actionUpdate($id)
    {
        $model = Product::findOne($id);
        if ($model) {
            $model->load(Yii::$app->request->post());
            if ($model->save()) {
                return $model;
            }
            return $model->getErrors();
        }
        throw new NotFoundHttpException("Product not found.");
    }

    public function actionDelete($id)
    {
        $model = Product::findOne($id);
        if ($model) {
            $model->delete();
            return ['status' => 'Product deleted'];
        }
        throw new NotFoundHttpException("Product not found.");
    }
}
