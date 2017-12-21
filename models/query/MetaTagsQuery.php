<?php

namespace mrstroz\wavecms\metatags\models\query;

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
}
