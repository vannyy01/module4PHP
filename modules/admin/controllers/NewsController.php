<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\models\user\User;
use yii\filters\AccessControl;
use app\modules\admin\models\UploadForm;
use app\models\news\News;
use app\modules\admin\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
                        'actions' => [],
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $img = new UploadForm();

        if ($model->load(Yii::$app->request->post()) && $model->saveNews()) {
            if (Yii::$app->request->isPost) {
                $img->imageFile = UploadedFile::getInstance($img, 'imageFile');
                if ($img->upload()) {
                    // file is uploaded successfully
                    return $this->redirect(['view', 'id' => $model->news_id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'img' => $img,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $img = new UploadForm();

        if ($model->load(Yii::$app->request->post()) && $model->saveNews()) {
            if (Yii::$app->request->isPost) {
                $img->imageFile = UploadedFile::getInstance($img, 'imageFile');
                if ($img->upload()) {
                    // file is uploaded successfully
                    return $this->redirect(['view', 'id' => $model->news_id]);
                }
            }
            return $this->redirect(['view', 'id' => $model->news_id]);

        }


        return $this->render('update', [
            'model' => $model,
            'img' => $img,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
