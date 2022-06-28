<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;

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
 * @property-read Category $parentCategory
 * @property-read User $createdBy
 * @property-read User $updatedBy
 * @property-read Category $childCategory
 * @property-read User $owner
 * @property int $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'code', 'is_featured', 'owner_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['code', 'name', 'owner_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['status', 'availability'], 'string', 'max' => 20],
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

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Owner]].
     *
     * @return ActiveQuery
     */
    public function getOwner(): ActiveQuery
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * Gets query for [[ParentCategory]].
     *
     * @return ActiveQuery
     */
    public function getParentCategory(): ActiveQuery
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[ParentCategory]].
     *
     * @return ActiveQuery
     */
    public function getChildCategory(): ActiveQuery
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }
}
