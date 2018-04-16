<?php

namespace mrstroz\wavecms\metatags;

use mrstroz\wavecms\components\helpers\FontAwesome;
use Yii;
use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;

/**
 * Class Bootstrap
 * @package mrstroz\wavecms\metatags
 * Boostrap class for wavecms metatags
 */
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {

        /** Set backend language based on user lang (Must be done before define translations */
        if ($app->id === 'app-backend') {
            if (!Yii::$app->user->isGuest) {
                Yii::$app->language = Yii::$app->user->identity->lang;
            }
        }

        $this->initTranslations();

        if ($app->id === 'app-backend') {
            Yii::setAlias('@wavecms_metatags', '@vendor/mrstroz/yii2-wavecms-metatags');
        }
    }

    /**
     * Init translations
     */
    protected function initTranslations()
    {
        Yii::$app->i18n->translations['wavecms_metatags/*'] = [
            'class' => PhpMessageSource::class,
            'basePath' => '@wavecms_metatags/messages',
            'fileMap' => [
                'main' => 'main.php',
            ],
        ];
    }
}