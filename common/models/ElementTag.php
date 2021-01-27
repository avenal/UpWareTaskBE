<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%element_tag}}".
 *
 * @property int $id
 * @property int|null $element_id
 * @property int|null $tag_id
 *
 * @property Element $element
 * @property Tag $tag
 */
class ElementTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%element_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['element_id', 'tag_id'], 'integer'],
            [['element_id'], 'exist', 'skipOnError' => true, 'targetClass' => Element::className(), 'targetAttribute' => ['element_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'element_id' => 'Element ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * Gets query for [[Element]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ElementQuery
     */
    public function getElement()
    {
        return $this->hasOne(Element::className(), ['id' => 'element_id']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TagQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ElementTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ElementTagQuery(get_called_class());
    }
}
