<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "submittion_dead_line".
 *
 * @property integer $id
 * @property string $current_year
 * @property string $dead_line
 * @property string $aliasModel
 */
abstract class SubmittionDeadLine extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'submittion_dead_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['current_year', 'dead_line'], 'required'],
            [['current_year', 'dead_line'], 'safe'],
            [['current_year'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'current_year' => Yii::t('models', 'Current Year'),
            'dead_line' => Yii::t('models', 'Dead Line'),
        ];
    }




}
