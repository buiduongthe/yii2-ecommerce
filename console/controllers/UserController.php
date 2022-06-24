<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use common\models\Constant;
use yii\helpers\BaseConsole;
use yii\helpers\Console;

class UserController extends Controller
{

    public int $limit = 500;

    public function actionIndex()
    {
        echo "Begin processing" . PHP_EOL;
    }

    /**
     * @throws Exception
     */
    public function actionCreateToken($id)
    {

        if (BaseConsole::confirm("Are you sure?")) {
            echo "You confirmed YES" . PHP_EOL;
            $user = User::findOne($id);
            if (!empty($user)) {
                $user->access_token = Constant::generateAccessToken($this->id);
                $user->save(false);
                echo "Access Token:" . $user->access_token . PHP_EOL;
            } else {
                echo "Not found user" . PHP_EOL;
            }
        } else {
            echo "You confirmed NO" . PHP_EOL;
        }
    }

    public function actionGetToken($userId)
    {

        if (BaseConsole::confirm("Are you sure?")) {
            echo "You confirmed YES" . PHP_EOL;
            $user = User::findOne($userId);
            if (!empty($user)) {
                echo "Access Token:" . $user->access_token . PHP_EOL;
            } else {
                echo "Not found user" . PHP_EOL;
            }
        } else {
            echo "You confirmed NO" . PHP_EOL;
        }
    }

    /**
     * @throws Exception
     */
    public function actionSetPassword($userId, $newPassword = Constant::DEFAULT_PASSWORD)
    {
        if (BaseConsole::confirm("Are you sure?")) {
            echo "You confirmed YES" . PHP_EOL;
            $user = User::findOne($userId);
            if (!empty($user)) {
                $user->setPassword($newPassword);
                $user->removePasswordResetToken();
                $user->generateAuthKey();
                $user->save(false);
                echo "SET Password Successfully:" . $newPassword . PHP_EOL;
            } else {
                echo "Not found user" . PHP_EOL;
            }
        } else {
            echo "You confirmed NO" . PHP_EOL;
        }
    }

    

}