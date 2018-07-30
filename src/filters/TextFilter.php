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
     * @var Boolean
     */
    public $escape = false;

    public function __construct($model, $attribute, $escape = false, $options)
    {
        parent::__construct($model, $attribute, $options);
        $this->escape = $escape;
    }

    public function renderFilter()
    {

        return Html::activeTextInput($this->model, $this->attribute, $this->options);
    }

    public function executeQuery($activeQuery)
    {
        if ($this->escape == true) {
            return $activeQuery->andFilterWhere(['like', $this->attribute, $this->model->{$this->attribute}]);
        }
        return $activeQuery->andFilterCompare($this->attribute, $this->model->{$this->attribute});
    }

}
