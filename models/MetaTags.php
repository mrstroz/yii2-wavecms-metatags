<?php

namespace mrstroz\wavecms\metatags\models;

use Yii;

/**
 * This is the model class for table "meta_tags".
 *
 * @property integer $id
 * @property string $language
 * @property string $model
 * @property integer $model_id
 * @property string $title
 * @property string $description
 * @property string $keywords
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id'], 'integer'],
            [['language'], 'string', 'max' => 10],
            [['model', 'title', 'description', 'keywords'], 'string', 'max' => 255],
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
            'title' => Yii::t('wavecms_metatags/main', 'Title'),
            'description' => Yii::t('wavecms_metatags/main', 'Description'),
            'keywords' => Yii::t('wavecms_metatags/main', 'Keywords'),
        ];
    }

    /**
     * @inheritdoc
     * @return \mrstroz\wavecms\metatags\models\query\MetaTagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \mrstroz\wavecms\metatags\models\query\MetaTagsQuery(get_called_class());
    }

    /**
     * Return array of meta tags
     *
     * @param string $model Model name
     * @param integer $modelId Model id
     * @param string $lang Language
     * @return array
     */
    public function getMetaTags($model, $modelId, $lang)
    {
        $metaTags = self::find()->andWhere([
            'model' => $model,
            'model_id' => $modelId,
            'language' => $lang
        ])->asArray()->one();

        return $metaTags;
    }

    /**
     * Set meta tags
     *
     * @param array $values
     * @param string $model Model name
     * @param integer $modelId Model id
     * @param string $lang Language
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function setMetaTags($values, $model, $modelId, $lang)
    {
        /** @var MetaTags $metaTags */
        $metaTags = self::find()->andWhere([
            'model' => $model,
            'model_id' => $modelId,
            'language' => $lang
        ])->one();

        if (!$metaTags) {
            /** @var MetaTags $metaTags */
            $metaTags = Yii::createObject(MetaTags::class);
            $metaTags->model = $model;
            $metaTags->model_id = $modelId;
            $metaTags->language = $lang;
        }

        if ($values) {
            foreach ($values as $key => $val) {
                $metaTags->{$key} = $val;
            }
            $metaTags->save();
        }

        return $metaTags->toArray();
    }

    /**
     * Delete meta tags
     * @param string $model Model name
     * @param integer $modelId Model id
     * @return int
     */
    public function deleteMetaTags($model, $modelId)
    {
        return self::deleteAll([
            'model' => $model,
            'model_id' => $modelId,
        ]);

    }
}
