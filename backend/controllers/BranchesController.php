<?php

namespace backend\controllers;

use Yii;
use backend\models\Branches;
use backend\models\BranchesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Branches models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if(Yii::$app->request->post('hasEditable')) {
            
            $barnchId = Yii::$app->request->post('editableKey');
            
            $branch = Branches::findOne($barnchId);
        
            $posted = current($_POST['Branches']);
            $post = [];
            $post['Branches'] = $posted;
            if($branch->load($post)) {
                $branch->save();
                $output = 'my value';
                $out = Json::encode(['output' => $output, 'message' => '']);

            }
            echo $out;
            return;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('create-branch')) {
            $model = new Branches();
                
            
            
            if ($model->load(Yii::$app->request->post())) {
                $model->branch_created_date = date('Y:m:d h:m:s');
                if($model->save()) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }
    
    public function actionValidate()
    {     
        if(Yii::$app->user->can('create-branch')) {
            $model = new Branches();
            if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = 'json';
                return ActiveForm::validate($model);
            }
                 
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->branch_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branches::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLists($id)
    {
        $countBranches = Branches::find()->where(['companies_company_id' => $id])->count();
        
        $branches = Branches::find()->where(['companies_company_id' => $id])->all();
        
        if($countBranches > 0) {
            foreach ($branches as $branch) {
                echo '<option value="'.$branch->branch_id.'">'.$branch->branch_name.'</option>';
             }
        } else {
            echo '<option></option>';
        }
    }
    
    public function actionImportExcel()
    {
        $inputFile = 'uploads/branches_file.xlsx';
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPhpExcel = $objReader->load($inputFile);
        } catch (Exception $ex) {
            die("error");
        }
        
        $sheet = $objPhpExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        for($row =1; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row, NULL, TRUE, FALSE);
            if($row == 1) {
                continue;
            }
            
            $branch = new Branches();
            $branch_id = $rowData[0][0];
            $branch->companies_company_id = $rowData[0][1];
            $branch->branch_name = $rowData[0][2];
            $branch->branch_address = $rowData[0][3];
            $branch->branch_created_date = date('Y-m-d H:m:s');
            $branch->branch_status = $rowData[0][4];
            $branch->save();
        }
        die('okay');
    }
}
