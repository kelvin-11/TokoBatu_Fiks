<?php

namespace app\controllers;

use app\models\Category;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\Pesanan;
use app\models\PesananDetail;
use app\models\Products;
use app\models\Toko;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class LoginController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Anda telah Login');
            return $this->goHome();
        }

        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->role_id = 1;
            $model->status = $model::STATUS_ACTIVE;
            if ($model->save()) {
                // $message = Yii::$app->mailer->compose();
                // if (Yii::$app->user->isGuest) {
                //     $message->setFrom(['kelvinrohmatsetiaji@gmail.com' => 'Gagal']);
                // } else {
                //     $message->setFrom(Yii::$app->user->identity->email);
                // }
                // $message->setTo(Yii::$app->params['adminEmail'])
                //     ->setSubject('Message subject')
                //     ->setTextBody('Plain text content')
                //     ->send();
                Yii::$app->session->setFlash('success', 'Berhasil Register..Silahkan Login!');
                return $this->redirect(['login']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Anda telah Login');
            return $this->goHome();
        }

        $model = new User();
        if ($r = Yii::$app->request->post()) {
            $user = User::find()->where(['email' => $r['User']['email']])->one();
            if ($user) {
                if (Yii::$app->security->validatePassword($r['User']['password'], $user->password)) {
                    Yii::$app->user->login($user);
                    if ($user->role_id != 2) {
                        Yii::$app->session->setFlash('success', 'Berhasil Login');
                        return $this->goBack();
                    } else {
                        return $this->redirect(['admin/index']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Email atau Password anda salah!');
                    return $this->redirect('login');
                }
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
}
