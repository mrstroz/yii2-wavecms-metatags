<?php

namespace mrstroz\wavecms\metatags\components\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\bootstrap\Html;

class MetaTagsWidget extends Widget
{

    public $form;
    public $model;
    public $metaTitleAttribute = 'meta_title';
    public $metaDescriptionAttribute = 'meta_description';
    public $metaKeywordsAttribute = 'meta_keywords';


    /**
     * @throws \yii\base\InvalidConfigException
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->form)
            throw new InvalidConfigException(Yii::t('wavecms_metatags/main', 'Attribute {attribute} is not defined', ['attribute' => 'form']));

        if (!$this->model)
            throw new InvalidConfigException(Yii::t('wavecms_metatags/main', 'Attribute {attribute} is not defined', ['attribute' => 'model']));

        parent::init();
    }

    /**
     * @return string|void
     */
    public function run()
    {
        echo $this->form->field($this->model, $this->metaTitleAttribute);
        echo Html::beginTag('div', ['class' => 'row']);
        echo Html::beginTag('div', ['class' => 'col-md-6']);
        echo $this->form->field($this->model, $this->metaDescriptionAttribute)->textarea(['rows' => 6]);
        echo Html::endTag('div');
        echo Html::beginTag('div', ['class' => 'col-md-6']);
        echo $this->form->field($this->model, $this->metaKeywordsAttribute)->textarea(['rows' => 6]);
        echo Html::endTag('div');
        echo Html::endTag('div');
    }
}