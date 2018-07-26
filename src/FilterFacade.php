<?php


namespace advancedfilter\src;

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

    public function getModel()
    {
        return $this->_model;
    }

    public function getQuery()
    {
        $this->executeQuery();

        return $this->_query;
    }


    private function executeQuery()
    {
        foreach ($this->_filters as $key => $filter) {
            $this->_query = $filter->executeQuery($this->_query);
        }
    }

    public function getFilters()
    {
        return $this->_filters;
    }

    #region Add Filter Functions

    public function addTextFilter($attribute, $escape =false)
    {
        $this->_filters[$attribute] = new filters\TextFilter($this->_model, $attribute, $escape);
    }

    public function addNumericFilter($attribute)
    {
        $this->_filters[$attribute] = new filters\NumericFilter($this->_model, $attribute);
    }

    public function addDropDownFilter($attribute, $items = array())
    {
        $this->_filters[$attribute] = new filters\DropdownFilter($this->_model, $attribute, $items);
    }

    public function addTimeFilter($attribute)
    {
        $this->_filters[$attribute] = new filters\TimeFilter($this->_model, $attribute);
    }

    public function addDateFilter($attribute)
    {
        $this->_filters[$attribute] = new filters\DateFilter($this->_model, $attribute);
    }

    public function addDateTimeFilter($attribute)
    {
        $this->_filters[$attribute] = new filters\DateTimeFilter($this->_model, $attribute);
    }

    #endregion
}
