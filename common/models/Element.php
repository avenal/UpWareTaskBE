<?php

namespace common\models;

use Yii;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * This is the model class for table "{{%element}}".
 *
 * @property int $id
 * @property string|null $date_from
 * @property string|null $date_to
 * @property string|null $date_time
 * @property string|null $currency_name
 * @property float|null $currency_value
 * @property int|null $tag
 * @property int|null $consent
 *
 * @property Tag $tag0
 * @property ElementTag[] $elementTags
 */
class Element extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%element}}';
    }

    public function fields()
    {
        return ['id', 'date_from', 'date_to', 'date_time', 'currency_name', 'currency_value', 'consent', 'tag' => 'tag0', 'tags'];
    }

    public function extraFields()
    {
        return ['tag'];
    }

    public function behaviors()
    {
        return [
            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'tags',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_from', 'date_to', 'date_time'], 'safe'],
            [['currency_value'], 'number'],
            [['tag', 'consent'], 'integer'],
            array('tags', 'safe'),
            [['currency_name'], 'string', 'max' => 255],
            [['tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'date_time' => 'Date Time',
            'currency_name' => 'Currency Name',
            'currency_value' => 'Currency Value',
            'tag' => 'Tag',
            'consent' => 'Consent',
        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('element_tag', ['element_id' => 'id']);
    }
    /**
     * Gets query for [[Tag0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag0()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag']);
    }

    /**
     * Gets query for [[ElementTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElementTags()
    {
        return $this->hasMany(ElementTag::className(), ['element_id' => 'id']);
    }
}
