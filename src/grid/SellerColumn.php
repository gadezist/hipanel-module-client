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

class SellerColumn extends ClientColumn
{
    public $attribute     = 'seller_id';
    public $idAttribute   = 'seller_id';
    public $nameAttribute = 'seller';
    public $clientType    = 'reseller';
}
