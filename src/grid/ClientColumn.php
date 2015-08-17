<?php

/*
 * Client Plugin for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-client
 * @package   hipanel-module-client
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2014-2015, HiQDev (https://hiqdev.com/)
 */

namespace hipanel\modules\client\grid;

use hipanel\grid\DataColumn;
use hipanel\modules\client\widgets\combo\ClientCombo;
use Yii;
use yii\helpers\Html;

class ClientColumn extends DataColumn
{
    public $idAttribute = 'client_id';

    public $attribute = 'client_id';

    public $nameAttribute = 'client';

    public $format = 'html';

    /**
     * @var string the combo type. Available: `client` or `seller`
     */
    public $clientType;

    public function init()
    {
        parent::init();
        $this->visible = Yii::$app->user->can('support');
        if (!empty($this->grid->filterModel)) {
            if (!$this->filterInputOptions['id']) {
                $this->filterInputOptions['id'] = $this->attribute;
            }
            if (!$this->filter) {
                $this->filter = ClientCombo::widget([
                    'attribute'           => $this->attribute,
                    'model'               => $this->grid->filterModel,
                    'formElementSelector' => 'td',
                    'clientType'          => $this->clientType,
                ]);
            }
        }
    }

    public function getDataCellValue($model, $key, $index, $column)
    {
        return Html::a($model->{$this->nameAttribute}, ['@client/view', 'id' => $model->{$this->idAttribute}]);
    }
}
