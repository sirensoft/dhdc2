<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "csexx".
 *
 * @property integer $id
 * @property string $sex
 * @property string $sexname
 */
class Csex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'csexx';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex'], 'required'],
            [['sex'], 'string', 'max' => 3],
            [['sexname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sex' => 'Sex',
            'sexname' => 'Sexname',
        ];
    }
}
