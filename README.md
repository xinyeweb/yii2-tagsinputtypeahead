Bootstrap Tags Input Typeahead For Yii2
=======================================
Bootstrap Tags Input Typeahead For Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist xinyeweb/yii2-tagsinputtypeahead "*"
```

or add

```
"xinyeweb/yii2-tagsinputtypeahead": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
 <?= $form->field($model, 'tags')->widget(\xinyeweb\tagsinputtypeahead\TagsInputTypeahead::className(),[
            'data' => \yii\helpers\ArrayHelper::getColumn(\app\models\Tag::find()->asArray()->all(),'title')
    ]) ?>
```

tagsinput
https://github.com/xinyeweb/yii2-tagsinput
