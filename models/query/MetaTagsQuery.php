<?php

namespace mrstroz\wavecms\metatags\models\query;

use Yii;

/**
 * This is the ActiveQuery class for [[\mrstroz\wavecms\metatags\models\MetaTags]].
 *
 * @see \mrstroz\wavecms\metatags\models\MetaTags
 */
class MetaTagsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \mrstroz\wavecms\metatags\models\MetaTags[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \mrstroz\wavecms\metatags\models\MetaTags|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Return array of meta tags
     *
     * @param string $model Model name
     * @return MetaTagsQuery
     */
    public function getMetaTags($model)
    {

        $lang = Yii::$app->language;
        if (Yii::$app->id === 'app-backend') {
            $lang = Yii::$app->wavecms->editedLanguage;
        }

        return $this->andWhere([
            'model' => $model,
            'language' => $lang
        ]);

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
