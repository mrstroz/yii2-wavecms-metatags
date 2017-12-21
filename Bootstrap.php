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
        if ($app->id === 'app-backend') {
            Yii::setAlias('@wavecms_page', '@vendor/mrstroz/yii2-wavecms-metatags');

        }
    }

    /**
     * Init translations
     */
    protected function initTranslations()
    {
        Yii::$app->i18n->translations['wavecms_metatags/*'] = [
            'class' => PhpMessageSource::class,
            'basePath' => '@wavecms_page/messages',
            'fileMap' => [
                'main' => 'main.php',
            ],
        ];
    }
}