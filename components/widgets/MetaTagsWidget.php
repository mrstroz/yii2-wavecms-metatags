<?php

namespace mrstroz\wavecms\metatags\components\widgets;

use mrstroz\wavecms\metatags\models\MetaTags;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\base\Widget;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

class MetaTagsWidget extends Widget
{

    /** @var ActiveForm */
    public $form;
    /** @var Model */
    public $model;
    public $metaTitleAttribute = 'meta_title';
    public $metaDescriptionAttribute = 'meta_description';
    public $metaKeywordsAttribute = 'meta_keywords';
    public $noindexAttribute = 'noindex';


    /**
     * @throws \yii\base\InvalidConfigException
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->form)
            throw new InvalidConfigException(Yii::t('wavecms_metatags/main', 'Attribute {attribute} is not defined', ['attribute' => 'form']));

        if (!$this->model) {
            $this->model = Yii::createObject(MetaTags::class);
        }
//            throw new InvalidConfigException(Yii::t('wavecms_metatags/main', 'Attribute {attribute} is not defined', ['attribute' => 'model']));

        parent::init();
    }

    /**
     * @return string|void
     */
    public function run()
    {
        echo Html::beginTag('div', ['class' => 'row']);
        echo Html::beginTag('div', ['class' => 'col-md-8']);
        echo $this->form->field($this->model, $this->metaTitleAttribute);
        echo Html::endTag('div');
        echo Html::beginTag('div', ['class' => 'col-md-4']);
        echo Html::tag('b', Yii::t('wavecms_metatags/main', "Don't index this page by robots:"));
        echo $this->form->field($this->model, $this->noindexAttribute)->checkbox()->hint(Yii::t('wavecms_metatags/main', 'Following tag will be added to &lt;head&gt;:<br />&lt;meta name="robots" content="noindex"&gt;'));
        echo Html::endTag('div');
        echo Html::endTag('div');

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