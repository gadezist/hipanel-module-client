<?php
/**
 * Client module for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-client
 * @package   hipanel-module-client
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2018, HiQDev (http://hiqdev.com/)
 */
use hipanel\modules\client\models\Client;

$this->title = $model->login;
$this->params['subtitle'] = Yii::t('hipanel:client', 'Client detailed information') . ' #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('hipanel', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if ($model->type === Client::TYPE_EMPLOYEE) {
    echo $this->render('view/employee', compact('model'));
} else {
    echo $this->render('view/client', compact('model'));
}
