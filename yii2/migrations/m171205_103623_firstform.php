<?php

use yii\db\Migration;

/**
 * Class m171205_103623_firstform
 */
class m171205_103623_firstform extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%form_digital_signature}}', [
            'id' => $this->bigPrimaryKey(),
            'organisation_type' => $this->string(200)->notNull()->defaultValue('-'),
            'organisation' => $this->string(200)->notNull()->defaultValue('-'),
            'period' => $this->date()->notNull(), // no default value; have to set this
            'fullname' => $this->string(200)->notNull()->defaultValue('-'),
            'email' => $this->string(200)->notNull()->defaultValue('-'),
            'phone' => $this->string(10)->notNull()->defaultValue(''),
            'substitute_fullname' => $this->string(200)->notNull()->defaultValue('-'),
            'substitute_email' => $this->string(200)->notNull()->defaultValue('-'),
            'substitute_phone' => $this->string(10)->notNull()->defaultValue('-'),
            'published' => $this->smallInteger()->notNull()->unsigned()->defaultValue(0),
            'employees_sign' => $this->smallInteger()->notNull()->unsigned()->defaultValue(0),
            'employees_sign_digital' => $this->smallInteger()->notNull()->unsigned()->defaultValue(0),
            'training_action' => $this->string(200)->notNull()->defaultValue('-'),
            'training_action_other' => $this->string(2000)->notNull()->defaultValue('-'),
            'employees_trained' => $this->smallInteger()->notNull()->unsigned()->defaultValue(0),
            'procedures_digital' => $this->smallInteger()->notNull()->unsigned()->defaultValue(0),
            'procedures_titles' => $this->string(2000)->notNull()->defaultValue('-'),
            'created_at' => $this->integer()->defaultValue(null),
            'updated_at' => $this->integer()->defaultValue(null)
            ], $tableOptions);

        $this->createIndex('idx_form_digital_signature_period', '{{%form_digital_signature}}', 'period');
        $this->createIndex('idx_form_digital_signature_organisation', '{{%form_digital_signature}}', 'organisation');
        $this->createIndex('unique_form_digital_signature_organisation_period', '{{%form_digital_signature}}', ['organisation', 'period'], true);
        $this->createIndex('idx_form_digital_signature_updated_at', '{{%form_digital_signature}}', 'updated_at');
    }

    public function safeDown()
    {
        $this->dropTable('{{%form_digital_signature}}');
    }
}
