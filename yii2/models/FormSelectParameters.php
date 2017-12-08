<?php
namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%form_select_parameters}}".
 *
 * @property integer $id
 * @property string $form
 * @property string $field
 * @property string $identity
 * @property string $label
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $updated_at
 */
class FormSelectParameters extends \yii\db\ActiveRecord
{
    const DELETED = 1;
    const ACTIVE = 0;

    public $updated_at_str;
    public $created_at_str;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_select_parameters}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['form', 'identity', 'label'], 'required'],
            ['deleted', 'default', 'value' => 0],
            [['form', 'field', 'identity', 'label'], 'string', 'max' => 200],
            [['form', 'field', 'identity'], 'unique', 'targetAttribute' => ['form', 'field', 'identity'], 'message' => 'Το στοιχείο υπάρχει ήδη στη φόρμα.'],
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
            'id' => 'ID',
            'form' => 'Φόρμα',
            'field' => 'Πεδίο',
            'identity' => 'Κλειδί',
            'label' => 'Περιγραφή',
            'created_at' => 'Δημιουργήθηκε',
            'updated_at' => 'Ενημερώθηκε',
            'created_at_str' => 'Δημιουργήθηκε',
            'updated_at_str' => 'Ενημερώθηκε',
            'deleted' => 'Διεγραμμένο',
        ];
    }

    public function afterFind()
    {
        $this->created_at_str = date("d/m/Y H:i:s", $this->created_at);
        $this->updated_at_str = date("d/m/Y H:i:s", $this->updated_at);
    }

    /**
     * @inheritdoc
     * @return FormSelectParametersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormSelectParametersQuery(get_called_class());
    }
}
