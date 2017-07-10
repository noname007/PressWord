<?php
/**
 * Created by PhpStorm.
 * User: people2015
 * Date: 2017/6/30
 * Time: 11:19
 */

namespace app\controllers;


use app\models\Account;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yiier\merit\MeritBehavior;

class JifenController extends  Controller
{
    public function behaviors()
    {
        return [
            MeritBehavior::className(),
        ];
    }

    public function actionIndex()
    {
        $account = new Account();
        $account->load(\Yii::$app->request->queryParams,'');
        if(!$account->validate())
        {
            $errors = $account->getErrors();
            \Yii::info(VarDumper::dumpAsString($errors));
            echo current($errors)[0];
            \Yii::$app->end();
        }
        \Yii::$app->user->setIdentity($account);
    }
}