<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\Book;
use app\models\BookSearch;
use yii\data\Pagination;
use app\models\AuthAssignment;
use app\models\User;

class SiteController extends Controller
{
    public function beforeAction($action) {
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'language' => ['post'],
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

    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=12;
        
        $baiviet=[];
        
        if(isset($_GET['baiviet'])){
            $baiviet=  Book::findOne($_GET['baiviet']);
        }
        
        $query = Book::find()->orderBy([
	       'time_new'=>SORT_DESC,
		]);
        if(!Yii::$app->user->isGuest){
            if ( !Yii::$app->user->can('permission_monitor') ){
                $query->where('isbn=1 or user_id='.Yii::$app->user->id);
            }
        }else{
                $query->where('isbn=1');
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>10]);
        $models = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'baiviet'=>$baiviet,
            'models' => $models,
            'pages' => $pages,
        ]);
    }
    public function actionUpdateUser(){
        if(Yii::$app->user->id){
            $model = User::findOne(Yii::$app->user->id);
            if (isset($_POST['user']) ) {
                $user=$_POST['user'];
                $model['displayname']=$user['displayname'];
                $model['phone']=$user['phone'];
                $model['email']=$user['email'];
                if($model->save()){
                    return $this->redirect(['/site/user']);
                }
            }
            return $this->render('UpdateUser',[
                'model'=>$model,
            ]);
        }else{
            return $this->redirect('login.html');
        }
    }
    public function actionUser(){
        if(Yii::$app->user->id){
            $sql = 'SELECT * FROM user where id ='.Yii::$app->user->id;
            $user = User::findBySql($sql)->all(); 
            return $this->render('user',[
                'user'=>$user[0],
            ]);
        }
        else{
            return $this->redirect('login.html');
        }
    }

    public function actionRoutes()
    {
        return $this->render('routes');
    }
    
    /**
     * Ajax handler for language change dropdown list. Sets cookie ready for next request
     */
    public function actionLanguage()
    {
        if ( Yii::$app->request->post('_lang') !== NULL && array_key_exists(Yii::$app->request->post('_lang'), Yii::$app->params['languages']))
        {
            Yii::$app->language = Yii::$app->request->post('_lang');
            $cookie = new yii\web\Cookie([
            'name' => '_lang',
            'value' => Yii::$app->request->post('_lang'),
            ]);
            Yii::$app->getResponse()->getCookies()->add($cookie);
        }
        Yii::$app->end();
    }

    public function actionLogin()
    {
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

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $AuthAssignment             =   new AuthAssignment();
                    $AuthAssignment->item_name  =   'user';
                    $taouser                    =   User::find()
                                                        ->where(['username' => $user->username])
                                                        ->one();
                    $AuthAssignment->user_id    =   $taouser['id'];
                    $AuthAssignment->created_at =   $taouser['created_at'];
                    $AuthAssignment->save(false);
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
     public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
