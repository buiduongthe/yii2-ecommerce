<?php

namespace backend\models;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "badge".
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property string $class
 * @property string $status
 * @property string $availability
 * @property int|null $owner_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Badge extends \common\models\Badge
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'badge';
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
            [['name', 'color', 'class'], 'required'],
            [['owner_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['color', 'class', 'status', 'availability'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'color' => Yii::t('app', 'Color'),
            'class' => Yii::t('app', 'Class'),
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
