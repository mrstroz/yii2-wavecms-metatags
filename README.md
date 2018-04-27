# Yii2 WaveCMS meta tags
**Meta tags module for [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).** 

Please do all install steps first from [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run

```
composer require --prefer-source "mrstroz/yii2-wavecms-metatags" "~0.1.0"
```

or add

```
"mrstroz/yii2-wavecms-metatags": "~0.1.0"
```

to the require section of your `composer.json` file.


Required
--------

1. Run migration 

Add the `migrationPath` in `console/config/main.php` and run `yii migrate`:

```php
// Add migrationPaths to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => [
            '@vendor/mrstroz/yii2-wavecms-metatags/migrations'  
        ],
    ],
],
```

Or run migrates directly

```yii
yii migrate/up --migrationPath=@vendor/mrstroz/yii2-wavecms-metatags/migrations
```

2. Add behavior and attributes to your model 
```php
// ...
class Page extends ActiveRecord
{

    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    
    public function behaviors()
    {
        return [
            // ...
            'meta_tags' => [
                'class' => MetaTagsBehavior::className()
            ],
        ];
    }
```

3. Use `MetaTags` helper to register meta tags
```php
$page = Page::find()->one();
MetaTags::register($page);
```