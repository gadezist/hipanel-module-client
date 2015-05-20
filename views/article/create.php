<?php
/**
 * @link    http://hiqdev.com/hipanel-module-client
 * @license http://hiqdev.com/hipanel-module-client/license
 * @copyright Copyright (c) 2015 HiQDev
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hipanel\modules\ticket\models\Ticket */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Article',
]);
$this->breadcrumbs->setItems([
    ['label' => 'News and articles', 'url' => ['index']],
    $this->title,
]);
?>
<div class="ticket-create">
    <?= $this->render('_form', ['model' => $model]); ?>
</div>
