<?php
namespace app\models;

/**
 * This is the ActiveQuery class for [[FormDigitalSignature]].
 *
 * @see FormDigitalSignature
 */
class FormDigitalSignatureQuery extends \yii\db\ActiveQuery
{
    public function organisation($organisation)
    {
        return $this->andWhere(['like', 'REPLACE([[organisation]], \' \', \'\')', preg_replace('/\s+/u', '', $organisation)]);
    }

    /**
     * @inheritdoc
     * @return FormDigitalSignature[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FormDigitalSignature|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
