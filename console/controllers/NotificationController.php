<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Constant;
use yii\helpers\BaseConsole;
use yii\helpers\Console;

class NotificationController extends Controller
{

    public function actionIndex()
    {
        set_time_limit(0);
        if (BaseConsole::confirm("Are you sure?")) {
            echo "You confirmed YES" . PHP_EOL;
            Console::startProgress(0, 1000);
            for ($n = 1; $n <= 1000; $n++) {
                usleep(1000);
                Console::updateProgress($n, 1000);
            }
            Console::endProgress();
        } else {
            echo "You confirmed NO" . PHP_EOL;
            Console::startProgress(0, 1000, 'Counting objects: ', false);
            for ($n = 1; $n <= 1000; $n++) {
                usleep(1000);
                Console::updateProgress($n, 1000);
            }
            Console::endProgress("done." . PHP_EOL);
        }
    }

}