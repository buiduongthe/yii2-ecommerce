<?php

namespace backend\models;

use common\models\Constant;
use Yii;
use yii\base\Model;


class BadgeImport extends Model
{
    public $is_confirmed;
    public $excelFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_confirmed'], 'boolean'],
            [['excelFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'excelFile' => Yii::t('app', 'Tập tin Excel'),
            'is_confirmed' => Yii::t('app', 'Xác nhận xóa dữ liệu cũ'),
        ];
    }

    public function upload($folder, $attribute): string
    {
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        if ($this->validate()) {
            $path = "uploads/" . $year . "/" . $month . "/" . $day . "/" . $folder;
            $fileName = $year . $month . $day . '_' . Yii::$app->user->id . '_' . Yii::$app->security->generateRandomString(10) . '.' . $this->$attribute->extension;
            Constant::initFolderUpload($path);
            $fileNameUpload = $path . '/' . $fileName;
            $this->$attribute->saveAs(Yii::getAlias('@app/web/') . $fileNameUpload);
            return $fileNameUpload;
        } else {
            return "";
        }
    }

}
