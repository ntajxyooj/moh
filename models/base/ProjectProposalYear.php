<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "project_proposal_year".
 *
 * @property string $id
 * @property integer $submit_year
 * @property string $department_id
 * @property string $date
 *
 * @property \app\models\ProjectProposal[] $projectProposals
 * @property \app\models\Department $department
 * @property string $aliasModel
 */
abstract class ProjectProposalYear extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_proposal_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['submit_year', 'department_id', 'date'], 'required'],
            [['submit_year', 'department_id'], 'integer'],
            [['date'], 'safe'],
            [['department_id', 'submit_year'], 'unique', 'targetAttribute' => ['department_id', 'submit_year']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Department::className(), 'targetAttribute' => ['department_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'submit_year' => Yii::t('models', 'Submit Year'),
            'department_id' => Yii::t('models', 'Department ID'),
            'date' => Yii::t('models', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectProposals()
    {
        return $this->hasMany(\app\models\ProjectProposal::className(), ['project_proposal_year_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(\app\models\Department::className(), ['id' => 'department_id']);
    }




}
