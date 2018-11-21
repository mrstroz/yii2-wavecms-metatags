<?php

namespace mrstroz\wavecms\metatags\components\widgets;

use mrstroz\wavecms\components\widgets\ImageWidget;
use mrstroz\wavecms\metatags\models\MetaTags;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\bootstrap\Html;

class OgTagsWidget extends Widget
{

    public $form;
    public $model;
    public $ogTypeAttribute = 'og_type';
    public $ogTitleAttribute = 'og_title';
    public $ogDescriptionAttribute = 'og_description';
    public $ogImageAttribute = 'og_image';


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
        echo $this->form->field($this->model, $this->ogTitleAttribute)->hint('og:title');
        echo $this->form->field($this->model, $this->ogDescriptionAttribute)->textarea(['rows' => 6])->hint('og:description');
        echo Html::endTag('div');
        echo Html::beginTag('div', ['class' => 'col-md-4']);
        echo $this->form->field($this->model, $this->ogTypeAttribute)->hint('og:type');
        echo $this->form->field($this->model, $this->ogImageAttribute)->widget(ImageWidget::class)->hint('og:image');
        echo Html::tag('div',Yii::t('wavecms_metatags/main','Preferred size for Facebook: {size}',['size' => '1200 x 630']),['class' => 'alert alert-info']);
        echo Html::endTag('div');
        echo Html::endTag('div');


    }
}