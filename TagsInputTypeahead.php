<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/18
 * Time: 23:43
 */

namespace xinyeweb\tagsinputtypeahead;

use yii\helpers\Html;
use yii\widgets\InputWidget;
use yii\helpers\Json;

class TagsInputTypeahead extends InputWidget
{

    public $options = [
        'class' => 'form-control',
        'placeholder'=>'回车确定',
    ];
    public $clientOptions = [];
    public $data = [];
    public $clientEvents = [];
    public function init()
    {
        if (!isset($this->options['id'])) {
            if ($this->hasModel()) {
                $this->options['id'] = Html::getInputId($this->model, $this->attribute);
            } else {
                $this->options['id'] = $this->getId();
            }
        }
        TagsInputTypeaheadAsset::register($this->getView());
        $this->registerScript();
        $this->registerEvent();
    }
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeInput('text', $this->model, $this->attribute, $this->options);
        } else {
            echo Html::input('text', $this->name, $this->value, $this->options);
        }
    }
    public function registerScript()
    {
//        $clientOptions = [
//            'typeahead' => [
//                'source' => ['PHP', 'MySQL', 'SQL', 'PostgreSQL', 'HTML', 'CSS', 'HTML5', 'CSS3', 'JSON'],
//            ]
//        ];
//        $clientOptions = json_encode($clientOptions);
        //$clientOptions = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
$data = json_encode($this->data);
        $js = <<<EOF
var data = JSON.parse('{$data}');
var dataList = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),//查詢的屬性中有一個叫做name name為“new York ”， ，那么进行了Bloodhound.tokenizers.obj.whitespace("city")之后，无论用户输入New或者York，都能查到，而不用考虑空格.
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: $.map(data, function (city) {
        return {
            name: city
        };
    })
});
dataList.initialize();
EOF;
$js .= "jQuery('#{$this->options["id"]}').tagsinput({typeaheadjs: [{
          minLength: 1,
          highlight: true,
    },{
        minlength: 1,
        name: 'dataList',
        displayKey: 'name',
        valueKey: 'name',
        source: dataList.ttAdapter()
    }],
    freeInput: true});";
        $this->getView()->registerJs($js);
    }
    public function registerEvent()
    {
        if (!empty($this->clientEvents)) {
            $js = [];
            foreach ($this->clientEvents as $event => $handle) {
                $js[] = "jQuery('#{$this->options["id"]}').on('$event',$handle);";
            }
            $this->getView()->registerJs(implode(PHP_EOL, $js));
        }
    }
}