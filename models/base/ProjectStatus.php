<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "project_status".
 *
 * @property string $id
 * @property string $project_status
 *
 * @property \app\models\ProjectProgression[] $projectProgressions
 * @property string $aliasModel
 */
abstract class ProjectStatus extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_status'], 'required'],
            [['project_status'], 'string', 'max' => 255],
            [['project_status'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'project_status' => Yii::t('models', 'Project Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectProgressions()
    {
        return $this->hasMany(\app\models\ProjectProgression::className(), ['project_status_id' => 'id']);
    }




}
