<?php
/**
 * Client module for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-client
 * @package   hipanel-module-client
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2019, HiQDev (http://hiqdev.com/)
 */

use hipanel\modules\client\models\Contact;
use yii\helpers\Html;

/**
 * @var Contact $model
 * @var string $domainName
 * @var int $domainId
 * @var string $contactType
 */

$this->title = Yii::t('hipanel:client', 'Change contact for {name}', ['name' => Html::encode($domainName)]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('hipanel', 'Contact'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
    'model' => $model,
    'domainName' => $domainName,
    'domainId' => $domainId,
    'contactType' => $contactType,
]);
