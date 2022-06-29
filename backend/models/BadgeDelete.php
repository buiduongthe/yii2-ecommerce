<?php

namespace backend\models;

use common\models\Constant;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "badge".
 *
 */
class BadgeDelete extends \common\models\Badge
{
    public $is_confirmed;
    public $Ids;

    #[Pure] #[ArrayShape(['blamable' => "array"])]
    public function behaviors(): array
    {
        return [
            'blamable' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['owner_id', 'created_by'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by']
                ],
                'value' => Yii::$app->user->id,
            ],
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => Yii::$app->params['current_time'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_confirmed'], 'required', 'requiredValue' => 1, 'message' => Yii::t('app', 'Are you checked Confirm?')],
            [['is_confirmed'], 'boolean'],
            [['status'], 'in', 'range' => [Constant::STATUS_DEFAULT_ACTIVE, Constant::STATUS_DEFAULT_INACTIVE]],
            [['Ids'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }
}
