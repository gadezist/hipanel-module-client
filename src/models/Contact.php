<?php

/*
 * Client module for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-client
 * @package   hipanel-module-client
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\client\models;

use hipanel\behaviors\File;
use hipanel\modules\document\models\Document;
use Yii;

class Contact extends \hipanel\base\Model
{
    /*
     * @return array the list of attributes for this record
     */
    use \hipanel\base\ModelTrait;

    public $oldEmail;

    public function rules()
    {
        return [
            [['id', 'obj_id', 'client_id', 'seller_id'], 'integer'],
            [['type_id', 'state_id'], 'integer'],
            [['client_name'], 'safe'],
            [['create_time', 'update_time', 'created_date', 'updated_date'], 'date'],
            [['client', 'seller', 'state', 'type'], 'safe'],
            [['email', 'abuse_email', 'email_new'], 'email'],
            [['emails'], 'trim'],
            [['country', 'country_name', 'province', 'province_name'], 'safe'],
            [['postal_code'], 'safe'],
            [['city', 'street1', 'street2', 'street3', 'address'], 'safe'],
            [['voice_phone', 'fax_phone'], 'safe'],
            [['icq', 'skype', 'jabber', 'social_net'], 'safe'],
            [['roid', 'epp_id', 'remoteid', 'other_messenger'], 'safe'],
            [['name', 'first_name', 'last_name'], 'string'],
            [['birth_date', 'passport_date'], 'safe'],
            [['passport_no', 'passport_by', 'organization', 'password'], 'safe'],

            [['reg_data', 'vat_number', 'tax_comment', 'bank_details'], 'trim'],
            [['vat_number', 'tax_comment'], 'string', 'max' => 32],
            [['vat_rate'], 'number', 'max' => 99],

            [['remote', 'file'], 'safe'],
            [['email_confirmed'], 'boolean'],
            [['used_count'], 'integer'],
            [
                ['voice_phone', 'fax_phone'],
                'match',
                'pattern' => '/^[+]?[()0-9 .-]{3,20}$/',
                'message' => Yii::t('hipanel:client', 'This field must contains phone number in international format.')
            ],
            [
                [
                    'first_name',
                    'last_name',
                    'email',
                    'street1',
                    'city',
                    'country',
                    'postal_code',
                    'voice_phone',
                ],
                'required',
                'on' => ['create', 'update']
            ],

            [['pincode', 'oldEmail'], 'safe', 'on' => ['update']],

            [['isresident'], 'boolean', 'trueValue' => true, 'falseValue' => false],
            [['birth_date', 'passport_date'], 'safe', 'on' => ['update', 'create']],
            [
                [
                    // Для регистрации доменов в зоне RU в качестве физического лица
                    'passport_no',
                    'passport_by',

                    // Для регистрации доменов в зоне RU в качестве юридического лица
                    'organization_ru',
                    'director_name',
                    'inn',
                    'kpp',
                ],
                'safe'
            ],
            [
                ['email_confirmed', 'voice_phone_confirmed', 'fax_phone_confirmed'],
                'boolean',
                'trueValue' => true,
                'falseValue' => false
            ],
            [['name_confirm_level', 'address_confirm_level'], 'safe'],
            [
                ['voice_phone_confirm_date', 'fax_phone_confirm_date', 'email_confirm_date', 'address_confirm_date'],
                'safe'
            ],
            [['name_confirm_date'], 'safe'],

            [
                ['id'],
                'required',
                'on' => ['request-email-confirmation', 'request-phone-confirmation', 'delete', 'update']
            ],
        ];
    }

    public function attributeLabels()
    {
        return $this->mergeAttributeLabels([
            'name'              => Yii::t('hipanel', 'Name'),
            'first_name'        => Yii::t('hipanel:client', 'First name'),
            'last_name'         => Yii::t('hipanel:client', 'Last name'),
            'organization'      => Yii::t('hipanel:client', 'Organization'),
            'abuse_email'       => Yii::t('hipanel:client', 'Abuse email'),
            'passport_no'       => Yii::t('hipanel:client', 'Passport number'),
            'icq'               => 'ICQ',
            'voice_phone'       => Yii::t('hipanel:client', 'Phone'),
            'fax_phone'         => Yii::t('hipanel:client', 'Fax'),
            'country_name'      => Yii::t('hipanel:client', 'Country'),
            'isresident'        => Yii::t('hipanel:client', 'RF resident'),
            'street1'           => Yii::t('hipanel:client', 'Street'),
            'street2'           => Yii::t('hipanel:client', 'Street'),
            'street3'           => Yii::t('hipanel:client', 'Street'),
            'inn'               => Yii::t('hipanel:client', 'Taxpayer identification number'),
            'kpp'               => Yii::t('hipanel:client', 'Code of reason for registration'),
            'organization_ru'   => Yii::t('hipanel:client', 'Organization (Russian title)'),
            'director_name'     => Yii::t('hipanel:client', 'Director\'s full name'),
            'address'           => Yii::t('hipanel:client', 'Address'),
            'city'              => Yii::t('hipanel:client', 'City'),
            'province'          => Yii::t('hipanel:client', 'Province'),
            'postal_code'       => Yii::t('hipanel:client', 'Postal code'),
            'birth_date'        => Yii::t('hipanel:client', 'Birth date'),
            'messengers'         => Yii::t('hipanel:client', 'Messengers'),
            'other_messenger'   => Yii::t('hipanel:client', 'Other messenger'),
            'passport_date'     => Yii::t('hipanel:client', 'Passport issue date'),
            'passport_by'       => Yii::t('hipanel:client', 'Issued by'),
            'social_net'        => Yii::t('hipanel:client', 'Social'),
            'reg_data'          => Yii::t('hipanel:client', 'Registration data'),
            'vat_number'        => Yii::t('hipanel:client', 'VAT number'),
            'vat_rate'          => Yii::t('hipanel:client', 'VAT rate'),
            'bank_details'      => Yii::t('hipanel:client', 'Bank details'),
        ]);
    }

    /**
     * Returns verification model for the $attribute
     *
     * @param string $attribute
     * @return Verification
     */
    public function getVerification($attribute)
    {
        return Verification::fromModel($this, $attribute);
    }

    public function getDocuments()
    {
        if (!Yii::getAlias('@document', false)) {
            return null;
        }

        return $this->hasMany(Document::class, ['object_id' => 'id'])->joinWith('file')->joinWith('statuses');
    }

    public function scenarioCommands()
    {
        return [
            'request-email-confirmation' => 'notify-confirm-email',
            'request-phone-confirmation' => 'notify-confirm-phone',
        ];
    }

    public function getName()
    {
        return $this->name ? : $this->first_name . ' ' . $this->last_name;
    }

    public function getMessengers()
    {
        $res = [];
        foreach (['skype' => 'Skype', 'icq' => 'ICQ', 'jabber' => 'Jabber'] as $k => $label) {
            if ($this->{$k}) {
                $res[] = "<b>$label:</b>&nbsp;" . $this->{$k};
            }
        }

        return implode('<br>', $res);
    }
}
