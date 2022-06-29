<?php

namespace common\models;

use Imagine\Image\Box;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Yii;
use yii\base\Exception;
use yii\imagine\Image;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Constant
{

    const SERVER_KEY = 'AAAALFsEmUo:APA91bF1jb9ufYIhatCPN7jrmRTAEN18ouw2bmXU0CrzkL1LMqw_a3Cz8y6I2UpS7gu1hrZg6SPVBTPFSbpW0Nm_TxxAeSN59822wlJeNM7XpQq265gZzQIkyqsYP4J3Rp-6LxCUS6sk';
    const DEFAULT_PASSWORD = 999999;

    const ROLE_ADMIN = "ADMIN";

    const IMAGE_THUMB = 'THUMB';
    const IMAGE_SMALL = 'SMALL';
    const IMAGE_MEDIUM = 'MEDIUM';
    const IMAGE_LARGE = 'LARGE';
    const IMAGE_ORIGIN = 'ORIGIN';
    const STATUS_DEFAULT_ACTIVE = 'ACTIVE';
    const STATUS_DEFAULT_INACTIVE = 'INACTIVE';

    #[ArrayShape([self::STATUS_DEFAULT_ACTIVE => "string", self::STATUS_DEFAULT_INACTIVE => "string"])]
    public static function DefaultStatus(): array
    {
        return [
            Constant::STATUS_DEFAULT_ACTIVE => Yii::t('app', 'Active'),
            Constant::STATUS_DEFAULT_INACTIVE => Yii::t('app', 'Inactive'),
        ];
    }

    #[ArrayShape([self::STATUS_DEFAULT_ACTIVE => "string", self::STATUS_DEFAULT_INACTIVE => "string"])]
    public static function DefaultAvailability(): array
    {
        return [
            Constant::STATUS_DEFAULT_ACTIVE => Yii::t('app', 'Active'),
            Constant::STATUS_DEFAULT_INACTIVE => Yii::t('app', 'Inactive'),
        ];
    }

    public static function MarkFeatured($string): string
    {
        return $string . " <i class='far fa-star' style='color:yellow;font-weight: bold'></i>";
    }

    public static function DistanceBetweenPoints($lat1, $lon1, $lat2, $lon2, $unit): float|int
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

    public static function getTextFromArray($Array, $key)
    {
        return !empty($Array[$key]) ? $Array[$key] : null;
    }

    public static function PhoneNumber($country_prefix, $national_number): ?string
    {
        if (empty($country_prefix) || empty($national_number)) {
            return null;
        }
        $national_number = preg_replace("/[^\d]/", "", $national_number);
        $length = strlen($national_number);
        switch ($length) {
            case 7:
                {
                    $national_number = preg_replace("/^1?(\d)(\d{3})(\d{3})$/", "$1 $2 $3", $national_number);
                }
                break;
            case 8:
                {
                    $national_number = preg_replace("/^1?(\d{2})(\d{3})(\d{3})$/", "$1 $2 $3", $national_number);
                }
                break;
            case 9:
                {
                    $national_number = preg_replace("/^1?(\d{3})(\d{3})(\d{3})$/", "$1 $2 $3", $national_number);
                }
                break;
            case 10:
                {
                    $national_number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1 $2 $3", $national_number);
                }
                break;
        }
        return "(" . $country_prefix . ") " . ($national_number);
    }

    public static function NationalNumberPattern(): string
    {
        return "/((028|052|096|097|098|032|033|034|035|055|036|037|038|039|090|093|070|071|072|076|077|078|079|091|094|081|082|083|084|085|086|087|088|089|099|092|056|058|095)+([0-9]{7})\b)/";
    }

    public static function getErrorMassage($model)
    {
        if (is_array($model)) {
            return !empty(array_values($model)[0][0]) ? PHP_EOL . array_values($model)[0][0] : array_values($model);
        } else return $model;
    }

    public static function createSignature($value): bool|string
    {
        return hash('sha256', self::SERVER_KEY . $value);
    }

    #[Pure]
    public static function checkSignature($signature, $value): bool
    {
        return self::createSignature($value) == $signature;
    }

    /**
     * @throws Exception
     */

    public static function generateAccessToken($userId): string
    {
        $random = \Yii::$app->security->generateRandomString(64);
        $u = base64_encode($userId);
        $checksum = self::createSignature($userId);
        return $checksum . "/" . $random . "/" . $u;
    }

    public static function generateImagesWithSizes($fileName, $filePath, $width, $height): string
    {
        $source = $filePath . '/' . $fileName;
        $target = $filePath . '/' . $width . 'x' . $height;
        self::initFolder($target);
        if (php_sapi_name() == 'cli') {
            @ini_set('memory_limit', '128M');
        }
        Image::getImagine()->open($source)->thumbnail(new Box($width, $height))->save($target . '/' . $fileName, ['quality' => 100]);
        return $filePath . '/' . $width . 'x' . $height . '/' . $fileName;
    }

    public static function initFolder($path)
    {
        $pathInit = $path;
        if (!is_dir($pathInit)) {
            mkdir($pathInit, 0777, $recursive = true);
            chmod($pathInit, 0777);
        } else {
            if (!is_writable($path)) {
                system("/bin/chmod -R 0777 $pathInit");
            }
        }
    }

    public static function getUrlImageSize($rootMedia, $filePath, $size = Constant::IMAGE_ORIGIN)
    {
        if (empty($filePath) || !file_exists($rootMedia . $filePath)) {
            return '';
        }
        if ($size == Constant::IMAGE_ORIGIN || empty(Yii::$app->params['images']['sizes'][$size])) {
            return $filePath;
        }
        $arrStr = explode('/', $filePath);
        $fileName = end($arrStr);
        array_pop($arrStr);
        $path = implode('/', $arrStr);
        $width = Yii::$app->params['images']['sizes'][$size]['width'];
        $height = Yii::$app->params['images']['sizes'][$size]['height'];
        $image = $path . '/' . $width . 'x' . $height . '/' . $fileName;
        if (!file_exists($rootMedia . $image)) {
            self::generateImagesWithSizes($fileName, $path, $width, $height);
        }
        return $image;

    }

    public static function FormatDateTime($timestamp, $format = 'd-m-Y H:i:s'): string
    {
        return !empty($timestamp) ? date($format, $timestamp / 1000) : "";
    }


    public static function initFolderUpload($path)
    {
        $pathInit = Yii::getAlias('@app/web/') . $path;

        if (!is_dir($pathInit)) {
            mkdir($pathInit, 0777, $recursive = true);
            chmod($pathInit, 0777);
        } else {
            if (!is_writable($pathInit)) {
                system("/bin/chmod -R 0777 $pathInit");
            }
        }
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public static function ReadExcel($filePath, $row)
    {

        try {
            $inputFileType = IOFactory::identify($filePath);
            $reader = IOFactory::createReader($inputFileType);
            $objExcel = $reader->load($filePath);
        } catch (\yii\base\Exception $ex) {
            return false;
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
        }

        $sheet = $objExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $returnData = [];
        for ($row; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, true);
            $returnData[] = $rowData[0];
        }

        return $returnData;
    }

    public static function getProductSalePercent($origin, $sale, $type)
    {
        if ($type == 1) {
            return round(100 - ($sale / $origin) * 100, 1);
        }
        if ($type == 2) {
            return round(100 - ($sale / $origin) * 100, 1) . "%";
        }
    }

    public static function StringReplace($str)
    {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return str_replace(' ', '_', $str);
    }
}