<?php
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%form_digital_signature}}".
 *
 * @property integer $id
 * @property string $organisation_type
 * @property string $organisation
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $substitute_fullname
 * @property string $substitute_email
 * @property string $substitute_phone
 * @property integer $published
 * @property integer $employees_sign
 * @property integer $employees_sign_digital
 * @property string $training_action
 * @property string $training_action_other
 * @property integer $employees_trained
 * @property integer $procedures_digital
 * @property string $procedures_titles
 * @property integer $created_at
 * @property integer $updated_at
 */
class FormDigitalSignature extends \yii\db\ActiveRecord
{

    const SCENARIO_SELECT_ORGANISATION = 'SCENARIO_SELECT_ORGANISATION';

    public $period_in;
    public $updated_at_str;
    public $created_at_str;
    public $joint_organisation_type, $joint_organisation; // used for exports

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_digital_signature}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organisation'], 'required', 'on' => [self::SCENARIO_DEFAULT, self::SCENARIO_SELECT_ORGANISATION]],
            [['period_in'], 'date', 'format' => 'php:m-Y', 'timestampAttribute' => 'period'],
            [['period'], 'filter', 'filter' => function ($value) {
                    return date('Y-m-d', strtotime('first day of this month', $value));
                }
            ],
            [['period_in', 'period', 'published', 'employees_sign', 'employees_sign_digital', 'employees_trained', 'procedures_digital', 'organisation_type', 'organisation', 'fullname', 'email', 'substitute_fullname', 'substitute_email', 'training_action', 'phone', 'substitute_phone'], 'required', 'except' => [self::SCENARIO_SELECT_ORGANISATION]],
            [['period', 'organisation'], 'unique', 'targetAttribute' => ['period', 'organisation'], 'message' => 'Έχουν ήδη καταχωρηθεί στοιχεία για την περίοδο'],
            [['published', 'employees_sign', 'employees_sign_digital', 'employees_trained', 'procedures_digital', 'created_at', 'updated_at'], 'integer'],
            [['organisation_type', 'organisation', 'fullname', 'email', 'substitute_fullname', 'substitute_email', 'training_action'], 'string', 'max' => 200],
            [['organisation_type'], 'in', 'range' => \app\models\FormDigitalSignature::selectableChoices('organisation_type')],
            [['training_action'], 'in', 'range' => \app\models\FormDigitalSignature::selectableChoices('training_action')],
            [['email', 'substitute_email'], 'email'],
            [['phone', 'substitute_phone'], 'string', 'max' => 10],
            [['phone', 'substitute_phone'], 'match', 'pattern' => '/^[62][0-9]{9}$/'],
            [['training_action_other', 'procedures_titles'], 'string', 'max' => 2000],
            [['training_action_other'], 'required', 'when' => function ($model, $attribute) {
                    return $model->training_action == 'ΑΛΛΟ';
                }, 'whenClient' => "function (attribute, value) { return \$('#formdigitalsignature-training_action').val() === 'ΑΛΛΟ'; }"
            ],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Κωδικός',
            'organisation_type' => 'Κατηγορία φορέα',
            'joint_organisation_type' => 'Κατηγορία φορέα',
            'organisation' => 'Φορέας',
            'joint_organisation' => 'Φορέας',
            'period' => 'Μήνας αναφοράς',
            'period_in' => 'Μήνας αναφοράς',
            'fullname' => 'Ονοματεπώνυμο υπεύθυνου',
            'email' => 'Email υπεύθυνου',
            'phone' => 'Τηλέφωνο υπεύθυνου',
            'substitute_fullname' => 'Ονοματεπώνυμο αναπληρωτή',
            'substitute_email' => 'Email αναπληρωτή',
            'substitute_phone' => 'Τηλέφωνο αναπληρωτή',
            'published' => 'Έχετε δημοσιεύσει στο διαδικτυακό τόπο του φορέα σας το εσωτερικό κανονισμό ηλεκτρονικής έκδοσης και διακίνησης εγγράφων με χρήση ψηφιακών υπογραφών',
            'employees_sign' => 'Αριθμός υπαλλήλων με δικαίωμα υπογραφής στο φορέα σας',
            'employees_sign_digital' => 'Αριθμός υπαλλήλων που έχουν δικαίωμα υπογραφής και έχουν ήδη ψηφιακή υπογραφή',
            'training_action' => 'Ενέργειες στις οποίες έχετε προβεί για την εκπαίδευση των υπαλλήλων σας',
            'training_action_other' => 'Αν απαντήσατε "ΑΛΛΟ" στις ενέργειες στις οποίες έχετε προβεί για την εκπαίδευση των υπαλλήλων σας, αναφέρετε τις ενέργειες',
            'employees_trained' => 'Αριθμός υπαλλήλων που έχουν εκπαιδευτεί στη χρήση ψηφιακών υπογραφών',
            'procedures_digital' => 'Αριθμός διαδικασιών που διεκπεραιώνονται με χρήση ψηφιακής υπογραφής',
            'procedures_titles' => 'Τίτλος διαδικασίας που διεκπεραιώνεται με χρήση ψηφιακής υπογραφής',
            'created_at' => 'Δημιουργήθηκε',
            'updated_at' => 'Ενημερώθηκε',
            'created_at_str' => 'Δημιουργήθηκε',
            'updated_at_str' => 'Ενημερώθηκε',
        ];
    }

    /**
     * Get a list of available choices in the form of
     * IDENTITY => LABEL suitable for select lists.
     *
     */
    public static function selectables()
    {
        $choices_aq = new FormDigitalSignatureQuery(get_called_class());

        return ArrayHelper::map($choices_aq->all(), 'organisation', 'organisation');
    }

    /**
     * Get a list of available choices in the form of
     * IDENTITY => LABEL suitable for select lists.
     *
     * @param string $field For which field to get parameters
     * @return mixed
     */
    public static function selectableChoices($field)
    {
        $choices_aq = FormSelectParameters::find()
            ->form(__CLASS__)
            ->field($field)
            ->active();

        return ArrayHelper::map($choices_aq->all(), 'identity', 'label');
    }

    public function afterFind()
    {
        $this->joint_organisation_type = Yii::$app->params[\app\models\FormDigitalSignature::class]['joint_organisation_type'];
        $this->joint_organisation= Yii::$app->params[\app\models\FormDigitalSignature::class]['joint_organisation'];

        $this->period_in = date("m-Y", strtotime($this->period));
        $this->created_at_str = date("d/m/Y H:i:s", $this->created_at);
        $this->updated_at_str = date("d/m/Y H:i:s", $this->updated_at);
    }

    /**
     * @inheritdoc
     * @return FormDigitalSignatureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormDigitalSignatureQuery(get_called_class());
    }
}
