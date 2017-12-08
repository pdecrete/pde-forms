<?php
namespace app\models;

/**
 * This is the ActiveQuery class for [[FormSelectParameters]].
 *
 * @see FormSelectParameters
 */
class FormSelectParametersQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['deleted' => false]);
    }

    public function deleted()
    {
        return $this->andWhere(['deleted' => true]);
    }

    public function form($form)
    {
        return $this->andWhere(['form' => $form]);
    }

    public function field($field)
    {
        return $this->andWhere(['field' => $field]);
    }

    /**
     * @inheritdoc
     * @return FormSelectParameters[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FormSelectParameters|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
