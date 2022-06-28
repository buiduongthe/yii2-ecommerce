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
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $code
 * @property string $name
 * @property int $is_featured
 * @property string $status
 * @property string $availability
 * @property int $owner_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class Category extends \common\models\Category
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

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
            [['parent_id', 'is_featured', 'owner_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
//            [['parent_id'], 'required', 'when' => function ($model) {
//                return $model->parent_id > 0;
//            },],
            [['code', 'name'], 'required'],
            [['code','name'], 'string', 'max' => 50],
            [['parent_id'], 'default', 'value' => 0],
            //[['status', 'availability'], 'string', 'max' => 20],
            [['status', 'availability'], 'boolean', 'falseValue' => Constant::STATUS_DEFAULT_INACTIVE, 'trueValue' => Constant::STATUS_DEFAULT_ACTIVE],
            [['status', 'availability'], 'in', 'range' => [Constant::STATUS_DEFAULT_ACTIVE, Constant::STATUS_DEFAULT_INACTIVE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'is_featured' => Yii::t('app', 'Is Featured'),
            'status' => Yii::t('app', 'Status'),
            'availability' => Yii::t('app', 'Availability'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
