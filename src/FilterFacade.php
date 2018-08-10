<?php


namespace advancedfilter\src;

use Yii;
use advancedfilter\src\filters;

class FilterFacade
{

    /**
     * @var $_model \yii\db\ActiveRecord
     */
    private $_model;

    /**
     * @var yii\db\ActiveQuery;
     */
    private $_query;

    /**
     * @var \advancedfilter\src\base\Filter[]
     */
    private $_filters;

    public function __construct($model, $query)
    {
        $this->_model = $model;
        $this->_query = $query;
    }

    /**
     * @return \yii\db\ActiveRecord
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @return Yii\db\ActiveQuery
     */
    public function getQuery()
    {
        return $this->executeQuery();
    }

    /**
     * @return Yii\db\ActiveQuery
     */
    private function executeQuery()
    {
        foreach ($this->_filters as $key => $filter) {
            $this->_query = $filter->executeQuery($this->_query);
        }

        return $this->_query;
    }

    /**
     * @param string $panelTitle
     * @param int $column
     * @return string
     */
    public function render($panelTitle = '', $column = 3)
    {
        $view_file = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'advancedfilter' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . '_filter_panel_form.php';
        return Yii::$app->controller->renderFile($view_file, array('panelTitle' => $panelTitle, 'column' => $column, 'filters' => $this->_filters));
    }

    #region Filter Functions

    public function addBooleanFilter($attribute, $options = array('class'=>'form-control input-sm' ))
    {
        $this->_filters[$attribute] = new filters\BooleanFilter($this->_model, $attribute, $options);
    }

    public function addDateFilter($attribute, $options = array('class'=>'form-control input-sm' ))
    {
        $this->_filters[$attribute] = new filters\DateFilter($this->_model, $attribute, $options);
    }

    public function addDateIntervalFilter($attribute, $options = array('class'=>'form-control input-sm' ))
    {
        $this->_filters[$attribute] = new filters\DateIntervalFilter($this->_model, $attribute, $options);
    }

    public function addDateTimeFilter($attribute, $options = array('class'=>'form-control input-sm' ))
    {
        $this->_filters[$attribute] = new filters\DateTimeFilter($this->_model, $attribute, $options);
    }

    public function addDropDownFilter($attribute, $items = array(), $options = array('class'=>'form-control input-sm' ))
    {
        $this->_filters[$attribute] = new filters\DropdownFilter($this->_model, $attribute, $items, $options);
    }

    public function addNumericFilter($attribute, $options = array('class'=>'form-control input-sm' ))
    {
        $this->_filters[$attribute] = new filters\NumericFilter($this->_model, $attribute, $options);
    }

    public function addTextFilter($attribute, $escape = false, $options = array('class'=>'form-control input-sm' ))
    {
        $this->_filters[$attribute] = new filters\TextFilter($this->_model, $attribute, $escape, $options);
    }

    public function addTimeFilter($attribute, $options = array('class'=>'form-control input-sm' ))
    {
        $this->_filters[$attribute] = new filters\TimeFilter($this->_model, $attribute, $options);
    }

    #endregion


}
