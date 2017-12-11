<?php
namespace app\controllers;

use Yii;
use app\models\FormDigitalSignature;
use app\models\FormDigitalSignatureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use League\Csv\Writer;

/**
 * FormDigitalSignatureController implements the CRUD actions for FormDigitalSignature model.
 */
class FormDigitalSignatureController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return true === \Yii::$app->user->identity->is('admin');
                        }
                    ],
                    [
                        'actions' => ['new', 'add-organisation', 'select-organisation', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return true === \Yii::$app->user->identity->is('formuser');
                        }
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    public function actionNew($organisation = '')
    {
        $model = new FormDigitalSignature();

        if ($organisation === '') {
//            return $this->render('has-previous-submit');
            return $this->redirect(['select-organisation']);
        }

        $last_submission_model = FormDigitalSignature::find()
            ->organisation($organisation)
            ->orderBy(['period' => SORT_DESC])
            ->one();

        // if not a post, get previous info
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->organisation = $organisation;
            if (!empty($last_submission_model)) {
                Yii::$app->session->addFlash('danger', 'Τροφοδοτήθηκαν στοιχεία της καταχώρησης ' . $last_submission_model->period_in);
                $model->attributes = $last_submission_model->attributes;
                $model->period = null;
            }
            $model->organisation = $organisation;
        }
        return $this->render('new', [
                'model' => $model
        ]);
    }

    public function actionSelectOrganisation()
    {
        $model = new FormDigitalSignature(['scenario' => FormDigitalSignature::SCENARIO_SELECT_ORGANISATION]);

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['new', 'organisation' => $model->organisation]);
        } else {
            $existing_models = FormDigitalSignature::find()
                ->orderBy(['organisation_type' => SORT_ASC, 'organisation' => SORT_ASC])
                ->all();

            return $this->render('select-organisation', [
                    'models' => $existing_models
            ]);
        }
    }

    public function actionAddOrganisation()
    {
        $model = new FormDigitalSignature(['scenario' => FormDigitalSignature::SCENARIO_SELECT_ORGANISATION]);

        if ($model->load(Yii::$app->request->post())) {
            // check if organisation exists; just in case
            $existing = (int) FormDigitalSignature::find()
                    ->organisation($model->organisation)
                    ->count();

            if ($existing > 0) {
                Yii::$app->session->addFlash('danger', 'Φαίνεται πως υπάρχει ήδη φορέας με αυτή την ονομασία. Θα πρέπει να τον επιλέξετε από τη λίστα.');
                return $this->redirect(['select-organisation']);
            }
            return $this->redirect(['new', 'organisation' => $model->organisation]);
        } else {
            return $this->render('add-organisation');
        }
    }

    public function actionExport()
    {
        $searchModel = new FormDigitalSignatureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        $export_attributes = [
            'organisation',
            'joint_organisation_type',
            'joint_organisation',
//            'period',
            'created_at_str',
            'period_in',
            'fullname',
            'email',
            'phone',
            'substitute_fullname',
            'substitute_email',
            'substitute_phone',
            'published',
            'employees_sign',
            'employees_sign_digital',
            'training_action',
            'training_action_other',
            'employees_trained',
            'procedures_digital',
            'procedures_titles',
//            'created_at',
//            'updated_at',
//            'created_at_str',
//            'updated_at_str'
        ];
        $headers = array_map(function ($v) use ($searchModel) {
            return $searchModel->getAttributeLabel($v);
        }, $export_attributes);



        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne($headers);
        $data = $dataProvider->query
            ->orderBy(['period' => SORT_DESC, 'organisation' => SORT_ASC])
            ->all();

        $exported_data = array_map(function ($datamodel) use ($export_attributes) {
            return array_map(function ($attribute) use ($datamodel) {
                return $datamodel->$attribute;
            }, $export_attributes);
        }, $data);
        $csv->insertAll($exported_data);
        $csv->output('ΣΤΟΙΧΕΙΑ-ΨΗΦΙΑΚΩΝ-ΥΠΟΓΡΑΦΩΝ-' . date('Y-m-d') . '.csv');
        \Yii::$app->end();
    }

    /**
     * Lists all FormDigitalSignature models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormDigitalSignatureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FormDigitalSignature model.
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
     * Updates an existing FormDigitalSignature model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FormDigitalSignature model.
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
     * Finds the FormDigitalSignature model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FormDigitalSignature the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FormDigitalSignature::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
