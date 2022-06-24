<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Constant;


class TestController extends Controller
{

    public int $limit = 500;

    public function actionIndex()
    {
        echo Constant::generateBookingCode();
    }

}