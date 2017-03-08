<?php
/**
 * Client module for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-client
 * @package   hipanel-module-client
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

use hipanel\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Inflector;

/**
 * @var string $scenario
 * @var array $countries
 * @var boolean $askPincode
 * @var \hipanel\modules\client\models\Contact $model
 */

$this->title = Yii::t('hipanel', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('hipanel:client', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => Inflector::titleize($model->getName(), true),
    'url' => ['view', 'id' => $model->id],
];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => 'contact-form',
    'action' => $model->scenario,
    'enableClientValidation' => true,
    'validateOnBlur' => true,
    'enableAjaxValidation' => true,
    'layout' => 'horizontal',
    'validationUrl' => Url::toRoute(['validate-form', 'scenario' => $model->scenario]),
]) ?>

<?php switch ($model->client_type) {
    case \hipanel\modules\client\models\Client::TYPE_EMPLOYEE:
        echo $this->render('update/employee', compact('scenario', 'countries', 'askPincode', 'model', 'form'));
        break;
    default:
        echo $this->render('update/client', compact('scenario', 'countries', 'askPincode', 'model', 'form'));
} ?>

<?php ActiveForm::end() ?>
