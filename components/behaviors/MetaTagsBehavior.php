<?php

namespace mrstroz\wavecms\metatags\components\behaviors;

use mrstroz\wavecms\metatags\models\MetaTags;
use Yii;
use yii\base\Behavior;
use yii\caching\Cache;
use yii\db\ActiveRecord;
use yii\di\Instance;

/**
 * MetaTagsBehavior Behavior. Allows to maintain translations of model.
 */
class MetaTagsBehavior extends Behavior
{

    /**
     * @var array The list of attributes.
     */
    public $attributes = ['title', 'description', 'keywords'];

    /**
     * @var string Prefix of attributes
     */
    public $prefix = 'meta';

    /**
     * @var string Component name for cache
     */
    public $cache = 'cache';

    /**
     * @var string Cache key
     */
    public $cacheKey = 'wavecms-metatags';

    /**
     * @var MetaTags meta tags model
     */
    public $model;

    /**
     * @var array Meta tags data
     */
    public $data;


    /**
     * Init model
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if ($this->cache !== null) {
            $this->cache = Instance::ensure($this->cache, Cache::class);
        }

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
            ActiveRecord::EVENT_AFTER_FIND => 'find',
            ActiveRecord::EVENT_AFTER_INSERT => 'update',
            ActiveRecord::EVENT_AFTER_UPDATE => 'update',
            ActiveRecord::EVENT_AFTER_DELETE => 'delete'
        ];
    }

    /**
     * Find event function
     * @param $event
     */
    public function find($event)
    {
        $formName = $event->sender->formName();
        $primaryKey = $event->sender->primaryKey;
        $cacheKey = $this->cacheKey . '_' . $formName . '_' . $primaryKey.'_'.$this->lang();


        if (!$this->cache instanceof Cache) {
            $this->data = $this->model->getMetaTags($formName, $primaryKey, $this->lang());
        } else {
            $cacheData = $this->cache->get($cacheKey);
            if (!empty($cacheData)) {
                $this->data = $cacheData;
            } else {
                $this->data = $this->model->getMetaTags($formName, $primaryKey, $this->lang());
                $this->cache->set($cacheKey, $this->data);
            }
        }


        if ($this->data) {
            foreach ($this->attributes as $attribute) {
                $event->sender->{$this->prefix . '_' . $attribute} = $this->data[$attribute];
            }
        }

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
        $cacheKey = $this->cacheKey . '_' . $formName . '_' . $primaryKey.'_'.$this->lang();

        foreach ($this->attributes as $attribute) {
            $values = [];
            if (isset($event->sender->{$this->prefix . '_' . $attribute})) {
                $values[$attribute] = $event->sender->{$this->prefix . '_' . $attribute};
            }
            if (count($values)) {
                $this->model->setMetaTags($values, $formName, $primaryKey, $this->lang());

                if ($this->cache instanceof Cache) {
                    $this->cache->delete($cacheKey);
                }

                if (Yii::$app->cacheFrontend instanceof Cache) {
                    Yii::$app->cacheFrontend->delete($cacheKey);
                }
            }
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
        $this->model->deleteMetaTags($event->sender->formName(), $event->sender->primaryKey);

        foreach(Yii::$app->wavecms->languages as $language) {
            $cacheKey = $this->cacheKey . '_' . $formName . '_' . $primaryKey.'_'.$language;
            if ($this->cache instanceof Cache) {
                $this->cache->delete($cacheKey);
            }

            if (Yii::$app->cacheFrontend instanceof Cache) {
                Yii::$app->cacheFrontend->delete($cacheKey);
            }
        }
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