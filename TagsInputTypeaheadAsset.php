<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/18
 * Time: 23:39
 */

namespace xinyeweb\tagsinputtypeahead;


use yii\web\AssetBundle;

class TagsInputTypeaheadAsset extends AssetBundle
{

    public $js = [
        'typeahead.bundle.js',
        'bootstrap-tagsinput.js',

    ];
    public $css = [
        'bootstrap-tagsinput.css',
        'bootstrap-tagsinput-typeahead.css'
    ];
    public $depends = ['yii\bootstrap\BootstrapPluginAsset'];

    public function init()
    {
        $this->sourcePath = dirname(__FILE__).DIRECTORY_SEPARATOR . 'assets';
    }
}