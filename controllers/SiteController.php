<?php

namespace app\controllers;

use app\models\category\Category;
use app\models\comments\Comments;
use app\models\CommentsForm;
use app\models\Login;
use app\models\news\News;
use app\models\NewsHasTag;
use app\models\tags\Tag;
use app\models\Signup;
use app\models\user\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use yii\web\ForbiddenHttpException;

class SiteController extends Controller
{
    public $category = [0 => "Аналітика", 1 => "Економіка", 2 => "Політика", 3 => "Спорт", 4 => "Суспільство", 5 => "Наука і Техніка"];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'about'],
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
                    [
                        'actions' => ['about'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->email);
                        }
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage and news list.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = News::find();

        $model = $model->orderBy('publ_date')
            ->limit(3)
            ->asArray()->all();

        $economics = News::find()->where('category_id = 1')->limit(5)->
        orderBy('publ_date DESC')->asArray()->all();

        $police = News::find()->where('category_id = 2')->limit(5)->
        orderBy('publ_date DESC')->asArray()->all();

        $sport = News::find()->where('category_id = 3')->limit(5)->
        orderBy('publ_date DESC')->asArray()->all();

        $society = News::find()->where('category_id = 4')->limit(5)->
        orderBy('publ_date DESC')->asArray()->all();

        $science = News::find()->where('category_id = 5')->limit(5)->
        orderBy('publ_date DESC')->asArray()->all();

        $analytics = News::find()->where('analytics = 1')->limit(5)->
        orderBy('publ_date DESC')->asArray()->all();

        $db = Yii::$app->db;
        $top_comments = $db->createCommand('SELECT user_id, user_name, COUNT(comment_id) as comments FROM `comments` GROUP by user_id ORDER by comments DESC LIMIT 5')->queryAll();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => count($top_comments),
        ]);
        $hot_themes = $db->createCommand('SELECT comments.news_id, news_name , COUNT(comment_id) as comments, publ_date FROM `comments`  INNER JOIN news ON comments.news_id = news.news_id WHERE UNIX_TIMESTAMP(publ_date) > UNIX_TIMESTAMP() - 24*60*60 GROUP BY news_id ORDER BY comments DESC LIMIT 3')->queryAll();
        return $this->render('index', [
            'model' => $model,
            'economics' => $economics,
            'police' => $police,
            'sport' => $sport,
            'society' => $society,
            'science' => $science,
            'analytics' => $analytics,
            'comments_pagination' => $pagination,
            'top_comments' => $top_comments,
            'top_news' => $hot_themes,
        ]);
    }

    /**
     * @return string and list news categories
     */
    public function actionCategories()
    {
        $category = Category::find()->asArray()->all();
        return $this->render('default-category',
            [
                'category' => $category,
            ]
        );
    }

    /**
     * @return string and list news of some category
     */
    public function actionCategory($id)
    {
        if ($id == 0) {
            $category = News::find()->orderBy('publ_date')->where("analytics = 1");
            $pagination = new Pagination([
                'defaultPageSize' => 4,
                'totalCount' => $category->count(),
            ]);
            $category = $category->offset($pagination->offset)->limit($pagination->limit)
                ->asArray()->all();

            return $this->render('category',
                [
                    'name' => 'Аналітика',
                    'category' => $category,
                    'pagination' => $pagination
                ]);
        } else {
            $category = News::find()->orderBy('publ_date')->where("category_id = $id");
            $name = Category::findOne([$id])['name'];
            $pagination = new Pagination([
                'defaultPageSize' => 4,
                'totalCount' => $category->count(),
            ]);
            $category = $category->offset($pagination->offset)->limit($pagination->limit)
                ->asArray()->all();

            return $this->render('category',
                [
                    'name' => $name,
                    'category' => $category,
                    'pagination' => $pagination
                ]);
        }
    }

    public function actionView($id)
    {
        $names = [];

        $news = News::find()->where("news_id = $id")->asArray()->one();
        $tags = NewsHasTag::find()->where("news_has_tag.news_news_id = $id")
            ->asArray()->all();
        $cat_id = $news['category_id'];
        $category = Category::find()->where("id =$cat_id")->asArray()->one()['name'];
        if (Yii::$app->user->isGuest && $news['analytics'] == 1) {
            $news_text = explode('.', $news['news_text']);
            $text = '';
            for ($i = 0; $i < 5; $i++) {
                $text .= $news_text[$i] . ".";
            }

            $message = '<h4><a href="/login/"><b>Для читання повної версії потрібно авторизуватися</b></a></h4>';
            return $this->render('view', [
                'category' => $category,
                'news' => $news,
                'text' => $text,
                'date' => date_create($news['publ_date']),
                'message' => $message,
                'tags' => $names
            ]);
        } else {
            $comments = Comments::find()->orderBy('raiting DESC')->where("news_id = $id AND is_good = 1")->asArray()->all();
            $addComment = new CommentsForm();
            foreach ($tags as $key => $tag) {
                $names[$key] = Tag::find()->where("id =" . $tag['tag_id'])->asArray()->one();
            }
            if (isset($_POST['CommentsForm'])) {
                $addComment->news_id = $id;
                $addComment->user_id = Yii::$app->user->identity->user_id;
                $addComment->user_name = Yii::$app->user->identity->user_name;
                $addComment->category_id = $cat_id;
                $addComment->attributes = Yii::$app->request->post('CommentsForm');
                if ($addComment->validate()) {
                    $addComment->post();
                    return $this->refresh();
                }
            }
            return $this->render('view', [
                'category' => $category,
                'news' => $news,
                'text' => $news['news_text'],
                'date' => date_create($news['publ_date']),
                'tags' => $names,
                'addComment' => $addComment,
                'comments' => $comments,
            ]);
        }
    }

    /**
     * @return mixed
     */

    public function actionIncrement($id)
    {
        $raiting = Comments::findOne(['comment_id' => $id]);
        $raiting->updateCounters(['raiting' => 1]);
        echo 1;
    }


    public function actionDecrement($id)
    {
        $raiting = Comments::findOne(['comment_id' => $id]);
        $raiting->updateCounters(['raiting' => -1]);

        echo 1;
    }


    /**
     * @param $id
     * @return string response about news with some tag
     */
    public function actionTags($id)
    {
        $news_id = [];
        $news = [];
        $seeking_tag = Tag::find()->where("id = $id")->asArray()->one();
        $tags = NewsHasTag::find()
            ->where("tag_id = $id")->asArray()->all();
        foreach ($tags as $key => $tag) {
            $news_id[$key] = $tag['news_news_id'];
        }
        foreach ($news_id as $key => $value) {
            $news[$key] = News::find()->where("news_id = $value")->asArray()->one();
        }

        return $this->render('tag', [
            'news' => $news,
            'tag' => $seeking_tag['name']
        ]);
    }

    public
    function actionSearch($q)
    {
        $q = trim(htmlspecialchars($q));
        $q = mb_strtolower($q, 'UTF-8');
        $tags = Tag::find()->where("name LIKE '%$q%'")
            ->asArray()->all();
        $tags = json_encode($tags, JSON_UNESCAPED_UNICODE);
        echo $tags;
    }

    /**
     * @return string|Response
     */
    public
    function actionSignup()
    {
        $model = new Signup();
        if (isset($_POST['Signup'])) {
            $model->attributes = Yii::$app->request->post('Signup');
            if ($model->validate() && $model->signup()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public
    function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $login_model = new Login();
        if (Yii::$app->request->post('Login')) {
            $login_model->attributes = Yii::$app->request->post('Login');
            if ($login_model->validate()) {
                Yii::$app->user->login($login_model->getUser());
                return $this->redirect(['index']);
            }
        }
        return $this->render('login', ['model' => $login_model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public
    function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLoginAdmin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            return $this->render('admin_login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public
    function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     * @throws ForbiddenHttpException
     */
    public
    function actionAbout()
    {
        return $this->render('about');
    }
}
