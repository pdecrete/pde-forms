<?php

use yii\db\Migration;

/**
 * Class m171208_064829_select_parameters
 */
class m171208_064829_select_parameters extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%form_select_parameters}}', [
            'id' => $this->bigPrimaryKey(),
            'form' => $this->string(200)->notNull()->defaultValue('-'),
            'field' => $this->string(200)->notNull()->defaultValue('-'),
            'identity' => $this->string(200)->notNull()->comment('Used for the "id" field'),
            'label' => $this->string(200)->notNull()->comment('Used for the "description" field'),
            'deleted' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer()->defaultValue(null),
            'updated_at' => $this->integer()->defaultValue(null)
            ], $tableOptions);

        $this->createIndex('unique_form_select_parameters_form_field', '{{%form_select_parameters}}', ['form', 'field', 'identity'], true);
        $this->createIndex('idx_form_select_parameters_deleted', '{{%form_select_parameters}}', 'deleted');
    }

    public function safeDown()
    {
        $this->dropTable('{{%form_select_parameters}}');
    }
}
