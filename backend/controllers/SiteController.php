<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'set-cookie', 'show-cookie'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
//        echo Yii::$app->MyComponent->currencyConverter('USD', 'VND', 100);
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    
    //Lesson 49
    public function actionSetCookie()
    {
        $cookie = new \yii\web\Cookie([
            'name' => 'test',
            'value' => 'Test cookie value'
        ]);
        
        Yii::$app->getResponse()->getCookies()->add($cookie);
    }
    
    // Lesson 49
    public function actionShowCookie()
    {
        if(Yii::$app->getRequest()->getCookies()->has('test')) {
            print_r(Yii::$app->getRequest()->getCookies()->getValue('test'));
        }
    }
}
