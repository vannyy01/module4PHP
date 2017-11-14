<?php

namespace app\modules\admin\controllers;
use yii\data\ActiveDataProvider;
use Yii;
use app\models\comments\Comments;
use app\modules\admin\models\CommentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentsController implements the CRUD actions for Comments model.
 */
class CommentsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel =  new CommentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'header' => 'Comments',
        ]);
    }

    public  function  actionPolice(){
        $searchModel =  new CommentsSearch();

        $dataProvider =  new ActiveDataProvider([
            'query' => Comments::find()->where('category_id = 2'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'header' => 'Police',
        ]);
    }

    /**
     * Displays a single Comments model.
     * @param string $comment_id
     * @param string $news_id
     * @param string $user_id
     * @return mixed
     */
    public function actionView($comment_id, $news_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($comment_id, $news_id, $user_id),
        ]);
    }

    /**
     * Creates a new Comments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'comment_id' => $model->comment_id, 'news_id' => $model->news_id, 'user_id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $comment_id
     * @param string $news_id
     * @param string $user_id
     * @return mixed
     */
    public function actionUpdate($comment_id, $news_id, $user_id)
    {
        $model = $this->findModel($comment_id, $news_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'comment_id' => $model->comment_id, 'news_id' => $model->news_id, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $comment_id
     * @param string $news_id
     * @param string $user_id
     * @return mixed
     */
    public function actionDelete($comment_id, $news_id, $user_id)
    {
        $this->findModel($comment_id, $news_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $comment_id
     * @param string $news_id
     * @param string $user_id
     * @return Comments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($comment_id, $news_id, $user_id)
    {
        if (($model = Comments::findOne(['comment_id' => $comment_id, 'news_id' => $news_id, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
