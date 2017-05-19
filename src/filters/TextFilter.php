<?php

namespace advancedfilter\src\filters;

use advancedfilter\src\base\Filter;
use yii\helpers\Html;

/**
 * Description of TextFilter
 *
 * @author Murat Çelik
 */
class TextFilter extends Filter
{

    /**
     *
     * @var type Boolean
     */
    public $escape = false;

    public function __construct($model, $attribute, $activeQuery, $escape = false, $options = array('class' => 'form-control input-sm')) {
        parent::__construct($model, $attribute, $activeQuery, $options);
        $this->escape = $escape;
    }

    public function drawFilter() {

        return Html::activeTextInput($this->model, $this->attribute, $this->options);
    }

    public function executeFilter() {
        if ($this->escape == true) {
            return $this->activeQuery->andFilterWhere(['like', $this->attribute, $this->model->{$this->attribute}]);
        }
        return $this->activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
