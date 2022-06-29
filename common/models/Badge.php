<?php

namespace common\models;

use Yii;

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
class Badge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'badge';
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
