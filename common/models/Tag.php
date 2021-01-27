<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Element[] $elements
 * @property ElementTag[] $elementTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }
    public function fields() {
        return ['id', 'title'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Elements]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ElementQuery
     */
    public function getElements()
    {
        return $this->hasMany(Element::className(), ['tag' => 'id']);
    }

    /**
     * Gets query for [[ElementTags]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ElementTagQuery
     */
    public function getElementTags()
    {
        return $this->hasMany(ElementTag::className(), ['tag_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TagQuery(get_called_class());
    }
}
