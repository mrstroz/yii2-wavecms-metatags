<?php

namespace mrstroz\wavecms\metatags\models;

use mrstroz\wavecms\components\behaviors\ImageBehavior;
use mrstroz\wavecms\metatags\models\query\MetaTagsQuery;
use Yii;

/**
 * This is the model class for table "meta_tags".
 *
 * @property integer $id
 * @property string $language
 * @property string $model
 * @property integer $model_id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $og_type
 * @property string $og_title
 * @property string $og_description
 * @property string $og_image
 */
class MetaTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meta_tags';
    }

    public function behaviors()
    {
        return [
            'og_image' => [
                'class' => ImageBehavior::class,
                'attribute' => 'og_image',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id'], 'integer'],
            [['language'], 'string', 'max' => 10],
            [['model', 'meta_title', 'meta_description', 'meta_keywords', 'og_type', 'og_title'], 'string', 'max' => 255],
            [['og_description'], 'string'],
            [['og_image'], 'image'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_metatags/main', 'ID'),
            'language' => Yii::t('wavecms_metatags/main', 'Language'),
            'model' => Yii::t('wavecms_metatags/main', 'Model'),
            'model_id' => Yii::t('wavecms_metatags/main', 'Model ID'),
            'meta_title' => Yii::t('wavecms_metatags/main', 'Title'),
            'meta_description' => Yii::t('wavecms_metatags/main', 'Description'),
            'meta_keywords' => Yii::t('wavecms_metatags/main', 'Keywords'),
            'og_type' => Yii::t('wavecms_metatags/main', 'Open Graph - type'),
            'og_title' => Yii::t('wavecms_metatags/main', 'Open Graph - title'),
            'og_description' => Yii::t('wavecms_metatags/main', 'Open Graph - description'),
            'og_image' => Yii::t('wavecms_metatags/main', 'Open Graph - image'),
        ];
    }

    /**
     * @inheritdoc
     * @return MetaTagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MetaTagsQuery(get_called_class());
    }

}
