<?php

namespace mrstroz\wavecms\metatags\components\helpers;

use Yii;
use yii\base\Component;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class MetaTags extends Component
{

    /**
     * Register meta tags
     * @param ActiveRecord $metaTags object should containt attributes $meta_title, $meta_description $meta_keywords
     */
    public static function register($metaTags)
    {

        if ($metaTags instanceof \mrstroz\wavecms\metatags\models\MetaTags) {

            if ($metaTags->meta_title) {
                Yii::$app->view->title = $metaTags->meta_title;
            }

            if ($metaTags->meta_description) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'description',
                    'content' => $metaTags->meta_description,
                ]);
            }

            if ($metaTags->meta_keywords) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'keywords',
                    'content' => $metaTags->meta_keywords,
                ]);
            }

            if ($metaTags->noindex) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'robots',
                    'content' => 'noindex',
                ]);
            }

            Yii::$app->view->registerMetaTag([
                'name' => 'og:url',
                'content' => Yii::$app->request->absoluteUrl,
            ]);

            if ($metaTags->og_type) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'og:type',
                    'content' => $metaTags->og_type,
                ]);
            }

            if ($metaTags->og_title) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'og:title',
                    'content' => $metaTags->og_title,
                ]);
            }

            if ($metaTags->og_description) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'og:description',
                    'content' => $metaTags->og_description,
                ]);
            }

            if ($metaTags->og_image) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'og:image',
                    'content' => Url::base(true) . '/images/' . $metaTags->og_image
                ]);

                list($width, $height) = getimagesize('images/' . $metaTags->og_image);

                if ($width) {
                    Yii::$app->view->registerMetaTag([
                        'name' => 'og:image:width',
                        'content' => $width
                    ]);
                }

                if ($height) {
                    Yii::$app->view->registerMetaTag([
                        'name' => 'og:image:height',
                        'content' => $height
                    ]);
                }
            }
        }

    }
}