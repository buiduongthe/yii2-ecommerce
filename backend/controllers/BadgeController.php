<?php

namespace backend\controllers;

use backend\models\BadgeDelete;
use backend\models\BadgeImport;
use common\models\Constant;
use common\models\User;
use PhpOffice\PhpSpreadsheet\Exception;
use Yii;
use backend\models\Badge;
use backend\models\search\BadgeSearch;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BadgeController implements the CRUD actions for Badge model.
 */
class BadgeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                ],
            ],
        ];
    }

    /**
     * Lists all Badge models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BadgeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Badge model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Badge model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionCreate()
    {
        $model = new Badge();

        if ($this->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    return $this->asJson(['success' => true, 'message' => 'Bạn tạo nhãn sản phảm thành công!']);
                } else {
                    throw new BadRequestHttpException(\Yii::t('app', 'Bạn tạo nhãn sản phảm lỗi: {error}', ['error' => Constant::getErrorMassage($model->errors)]));
                }
            } else {
                throw new BadRequestHttpException(\Yii::t('app', 'Bạn tạo nhãn sản phảm: {error}', ['error' => Constant::getErrorMassage($model->errors)]));
            }
        }
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Badge model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException|BadRequestHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    return $this->asJson(['success' => true, 'message' => 'Bạn cập nhật nhãn sản phẩm thành công!']);
                } else {
                    throw new BadRequestHttpException(\Yii::t('app', 'Bạn cập nhật nhãn sản phẩm lỗi: {error}', ['error' => Constant::getErrorMassage($model->errors)]));
                }
            } else {
                throw new BadRequestHttpException(\Yii::t('app', 'Bạn cập nhật nhãn sản phẩm lỗi: {error}', ['error' => Constant::getErrorMassage($model->errors)]));
            }
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Badge model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws BadRequestHttpException
     */
    public function actionDelete()
    {
        /**
         * @var User $user
         */
        $user = Yii::$app->user->identity;
        $model = new BadgeDelete();
        if (Yii::$app->request->isPost && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->load($this->request->post());
            $isConfirmed = filter_var($model->is_confirmed, FILTER_VALIDATE_BOOLEAN);
            if (!$isConfirmed) {
                throw new BadRequestHttpException(\Yii::t('app', 'Are you checked Confirm?') . $isConfirmed);
            }
            if (!empty($model->Ids)) {
                $places = Badge::find()
                    ->where([
                        'id' => explode(",", $model->Ids),
                        'status' => Constant::STATUS_DEFAULT_ACTIVE,
                        'owner_id' => $user->id
                    ])
                    ->all();;
                if (!$places) {
                    throw new BadRequestHttpException(\Yii::t('app', 'Place Not Found'));
                }
                Badge::deleteAll([
                    'id' => explode(",", $model->Ids),
                    'owner_id' => $user->id
                ]);
                return $this->asJson(['success' => true, 'message' => 'Bạn xóa địa điểm thành công!']);
            } else {
                throw new BadRequestHttpException(\Yii::t('app', 'Place Not Found'));
            }
        }
        return $this->renderAjax('_form_delete', ['model' => $model]);
    }

    /**
     * Finds the Badge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Badge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Badge::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Creates a new BookingTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return Response|string
     * @throws BadRequestHttpException
     * @throws Exception|\yii\db\Exception
     */
    public  function actionImport()
    {
        $model = new BadgeImport();

        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            /**
             * @var User $user
             */
            $user = Yii::$app->user->identity;
            set_time_limit(0);
            $transaction = Yii::$app->db->beginTransaction();

            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->load($this->request->post());
            if ($model->validate(false)) {
                $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
                if ($model->excelFile) {
                    $url = $model->upload('excel', 'excelFile');
                    if (!empty($url)) {
                        $dataRows = Constant::ReadExcel($url, 4);
                        if (!empty($dataRows)) {
                            $isConfirmed = filter_var($model->is_confirmed, FILTER_VALIDATE_BOOLEAN);
                            if ($isConfirmed) {
                                Badge::deleteAll(['owner_id' => $user->id]);
                            }
                            foreach ($dataRows as $dataRow) {
                                $modelBadge = new Badge();
                                $modelBadge->name = $dataRow[1];
                                $modelBadge->color = $dataRow[2];
                                $modelBadge->class = $dataRow[3];
                                $modelBadge->status = Constant::STATUS_DEFAULT_ACTIVE;
                                if (!$modelBadge->save()) {
                                    $transaction->rollBack();
                                    throw new BadRequestHttpException(\Yii::t('app', 'Bạn tạo nhãn sản phẩm lỗi: {error}', ['error' => Constant::getErrorMassage($modelBadge->errors)]));
                                }
                            }
                            $transaction->commit();
                            return $this->asJson(['success' => true, 'message' => 'Bạn nhập dữ liệu nhãn sản phẩm thành công!']);
                        } else {
                            throw new BadRequestHttpException("4. Tập tin excel không có dữ liệu!");
                        }
                    } else {
                        throw new BadRequestHttpException("3. Upload tập tin excel không thành công!");
                    }
                } else {
                    throw new BadRequestHttpException("2. Vui lòng chọn tập tin excel!");
                }
            } else {
                throw new BadRequestHttpException("1. Vui lòng kiểm tra tập tin Excel và nhập theo hướng dẫn!" . Constant::getErrorMassage($model->errors));
            }
        }
        return $this->renderAjax('_form_import', [
            'model' => $model,
        ]);
    }
}
