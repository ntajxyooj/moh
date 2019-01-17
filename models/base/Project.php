<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "project".
 *
 * @property string $id
 * @property string $project_name
 * @property string $sector_code
 * @property string $project_code
 * @property string $budget_code
 * @property string $project_start_year
 * @property string $project_end_year
 * @property string $payment_start_year
 * @property string $payment_end_year
 * @property string $project_type_id
 * @property double $govt_budget
 * @property double $approved_govt_budget
 * @property double $oda_budget
 * @property integer $approved
 * @property integer $is_oda
 * @property string $evaluation_at_plan
 * @property string $final_evaluation
 *
 * @property \app\models\Loan[] $loans
 * @property \app\models\ProjectType $projectType
 * @property \app\models\ProjectProgression[] $projectProgressions
 * @property string $aliasModel
 */
abstract class Project extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const EVALUATION_AT_PLAN_A = 'A';
    const EVALUATION_AT_PLAN_B = 'B';
    const EVALUATION_AT_PLAN_C = 'C';
    const EVALUATION_AT_PLAN_D = 'D';
    const EVALUATION_AT_PLAN_F = 'F';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_name', 'project_start_year', 'project_end_year', 'payment_start_year', 'payment_end_year', 'project_type_id'], 'required'],
            [['project_start_year', 'project_end_year', 'payment_start_year', 'payment_end_year'], 'safe'],
            [['project_type_id', 'approved', 'is_oda'], 'integer'],
            [['approved_govt_budget'], 'number'],
            [['evaluation_at_plan'], 'string'],
            [['project_name'], 'string', 'max' => 255],
            [['sector_code', 'project_code', 'budget_code', 'final_evaluation'], 'string', 'max' => 45],
            [['sector_code'], 'unique'],
            [['project_code'], 'unique'],
            [['budget_code'], 'unique'],
            [['project_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\ProjectType::className(), 'targetAttribute' => ['project_type_id' => 'id']],
            ['evaluation_at_plan', 'in', 'range' => [
                    self::EVALUATION_AT_PLAN_A,
                    self::EVALUATION_AT_PLAN_B,
                    self::EVALUATION_AT_PLAN_C,
                    self::EVALUATION_AT_PLAN_D,
                    self::EVALUATION_AT_PLAN_F,
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'project_name' => Yii::t('models', 'Project Name'),
            'sector_code' => Yii::t('models', 'Sector Code'),
            'project_code' => Yii::t('models', 'Project Code'),
            'budget_code' => Yii::t('models', 'Budget Code'),
            'project_start_year' => Yii::t('models', 'Project Start Year'),
            'project_end_year' => Yii::t('models', 'Project End Year'),
            'payment_start_year' => Yii::t('models', 'Payment Start Year'),
            'payment_end_year' => Yii::t('models', 'Payment End Year'),
            'project_type_id' => Yii::t('models', 'Project Type ID'),
            'govt_budget' => Yii::t('models', 'Govt Budget'),
            'approved_govt_budget' => Yii::t('models', 'Approved Govt Budget'),
            'oda_budget' => Yii::t('models', 'Oda Budget'),
            'approved' => Yii::t('models', 'Approved'),
            'is_oda' => Yii::t('models', 'Is Oda'),
            'evaluation_at_plan' => Yii::t('models', 'Evaluation At Plan'),
            'final_evaluation' => Yii::t('models', 'Final Evaluation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(\app\models\Loan::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectType()
    {
        return $this->hasOne(\app\models\ProjectType::className(), ['id' => 'project_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectProgressions()
    {
        return $this->hasMany(\app\models\ProjectProgression::className(), ['project_id' => 'id']);
    }




    /**
     * get column evaluation_at_plan enum value label
     * @param string $value
     * @return string
     */
    public static function getEvaluationAtPlanValueLabel($value){
        $labels = self::optsEvaluationAtPlan();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column evaluation_at_plan ENUM value labels
     * @return array
     */
    public static function optsEvaluationAtPlan()
    {
        return [
            self::EVALUATION_AT_PLAN_A => Yii::t('models', self::EVALUATION_AT_PLAN_A),
            self::EVALUATION_AT_PLAN_B => Yii::t('models', self::EVALUATION_AT_PLAN_B),
            self::EVALUATION_AT_PLAN_C => Yii::t('models', self::EVALUATION_AT_PLAN_C),
            self::EVALUATION_AT_PLAN_D => Yii::t('models', self::EVALUATION_AT_PLAN_D),
            self::EVALUATION_AT_PLAN_F => Yii::t('models', self::EVALUATION_AT_PLAN_F),
        ];
    }

}