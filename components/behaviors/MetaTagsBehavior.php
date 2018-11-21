<?php

namespace mrstroz\wavecms\metatags\components\behaviors;

use mrstroz\wavecms\metatags\models\MetaTags;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * MetaTagsBehavior Behavior. Allows to maintain meta tags of model.
 *
 * @property MetaTags $model
 * @property string $relationName
 */
class MetaTagsBehavior extends Behavior
{

    /**
     * @var MetaTags
     */
    public $model;

    /**
     * @var string
     */
    public $relationName = 'metaTags';

    /**
     * Init model
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->model = Yii::createObject(MetaTags::class);
        parent::init();
    }

    /**
     * Event list
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_INSERT => 'update',
            ActiveRecord::EVENT_AFTER_UPDATE => 'update',
            ActiveRecord::EVENT_AFTER_DELETE => 'delete'
        ];
    }

    /**
     * before validate event function - populate relation
     * @param $event
     * @throws \yii\base\InvalidConfigException
     */
    public function beforeValidate($event)
    {
        $formName = $event->sender->formName();
        $primaryKey = $event->sender->primaryKey;

        /** @var ActiveRecord $sender */
        $sender = $event->sender;

        /** @var MetaTags $metaTags */
        $metaTags = $sender->{$this->relationName};
        if (!$metaTags) {
            $metaTags = Yii::createObject(MetaTags::class);
            $metaTags->model = $formName;
            $metaTags->model_id = $primaryKey;
            $metaTags->language = $this->lang();
            $metaTags->load(Yii::$app->request->post());
        }

        $sender->populateRelation($this->relationName, $metaTags);
    }

    /**
     * Insert / update event function
     * @param $event
     * @throws \yii\base\InvalidConfigException
     */
    public function update($event)
    {
        $formName = $event->sender->formName();
        $primaryKey = $event->sender->primaryKey;

        /** @var ActiveRecord $sender */
        $sender = $event->sender;

        /** @var MetaTags $metaTags */
        $metaTags = $sender->{$this->relationName};
        if (!$metaTags) {
            $metaTags = Yii::createObject(MetaTags::class);
            $metaTags->model = $formName;
            $metaTags->model_id = $primaryKey;
            $metaTags->language = $this->lang();
        }
        $metaTags->load(Yii::$app->request->post());

        if ($metaTags->validate()) {
            $metaTags->save();
        }
    }

    /**
     * Delete event function
     * @param $event
     */
    public function delete($event)
    {
        $formName = $event->sender->formName();
        $primaryKey = $event->sender->primaryKey;

        $this->model::deleteAll([
            'model' => $formName,
            'model_id' => $primaryKey,
        ]);
    }

    /**
     * Return language
     * @return string
     */
    private function lang()
    {
        $lang = Yii::$app->language;
        if (Yii::$app->id === 'app-backend') {
            $lang = Yii::$app->wavecms->editedLanguage;
        }

        return $lang;
    }
}