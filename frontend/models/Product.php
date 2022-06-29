<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $sku
 * @property string $code
 * @property string $name
 * @property string $briefly
 * @property string $description
 * @property int $origin_price
 * @property int $sale_price
 * @property int $amount
 * @property int $is_featured
 * @property string $status
 * @property string $availability
 * @property int $owner_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_ar
 * @property string $is_badge [varchar(25)]
 * @property string $front_image_url [varchar(255)]
 * @property string $back_image_url [varchar(255)]
 */
class Product extends \common\models\Product
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'code', 'name', 'briefly', 'description', 'origin_price', 'sale_price', 'is_hot', 'owner_id', 'created_by', 'updated_by', 'created_at', 'updated_ar'], 'required'],
            [['category_id', 'origin_price', 'sale_price', 'amount', 'is_featured', 'owner_id', 'created_by', 'updated_by', 'created_at', 'updated_ar'], 'integer'],
            [['briefly', 'description'], 'string'],
            [['sku'], 'string', 'max' => 100],
            [['code', 'name','front_image_url','back_image_url'], 'string', 'max' => 255],
            [['is_badge','status', 'availability'], 'string', 'max' => 20],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'sku' => Yii::t('app', 'Sku'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'briefly' => Yii::t('app', 'Briefly'),
            'description' => Yii::t('app', 'Description'),
            'origin_price' => Yii::t('app', 'Origin Price'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'amount' => Yii::t('app', 'Amount'),
            'is_featured' => Yii::t('app', 'Is Featured'),
            'is_badge' => Yii::t('app', 'Is Hot'),
            'front_image_url' => Yii::t('app', 'Front Image Url'),
            'back_image_url' => Yii::t('app', 'Back Image Url'),
            'status' => Yii::t('app', 'Status'),
            'availability' => Yii::t('app', 'Availability'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_ar' => Yii::t('app', 'Updated Ar'),
        ];
    }
}
