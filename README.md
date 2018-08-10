# Advancedfilter For Yii2 GridView

Download manuel to application vendor/advancedfilter

Configuration

Add alias to application config 
```php
 'aliases' => [
        '@advancedfilter' => '@vendor/advancedfilter',
  ],
```
Usage
1) Define Property FilterFacade in Your SearchModel

```php
 class PostSearch extends Post{
     
    /**
     * @var \advancedfilter\src\FilterFacade
     */  
    public $filter = array();

}
```
2) Which filter do you want to add, in your search function

```php

class PostSearch extends Post{
     
    /**
     * @var \advancedfilter\src\base\Filter[]
     */  
    public $filters = array();

    public function search($params) {
    
       $query = Post::find()->alias('t');
       
       $dataProvider = new ActiveDataProvider([
           'query' => $query,
       ]);
       
       $this->load($params);
       
       if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
       }
       
       
       $this->filter = new \advancedfilter\src\FilterFacade($this, $query);
       
        // add filters that should always apply here
       
        $this->filter->addBooleanFilter('category.id_category');
        $this->filter->addDateFilter('t.date_add');
        $this->filter->addDateTimeFilter('t.datetime_publish');
        $this->filter->addDropDownFilter('category.id_category', array(''=>'',1=>'Sea',2=>'Mountain'));
        $this->filter->addNumericFilter('category.country.id_country');
        $this->filter->addTextFilter('title');
        $this->filter->addTextFilter('category.name');
        $this->filter->addTimeFilter('t.datetime_publish');
       
        $dataProvider->query = $this->filter->getQuery();
       
        return $dataProvider;
    }
}
```
2) Declare your Action on Controller

```php
class PostController extends Controller
{
   public function actionIndex() {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
}
```
3) In view file render html inputs
```php
<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>

<?= $searchModel->filter->render('My Filter Panel',4) ?>

<div class="post-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_post',
            'title',
        ],
    ]);
    ?>
</div>
```
