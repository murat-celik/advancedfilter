# Advancedfilter For Yii2 GridView

Configuration

Add Filter alias and Component to application config 
```php
 'aliases' => [
        '@advancedfilter' => '@vendor/advancedfilter',
  ],
 'components' => [
        'filter'=> function () {
            return new advancedfilter\src\components\FilterComponent();
        },
  ]
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
        $query = Post::find();,
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $this->filter =  new \advancedfilter\src\FilterFacade($this,$query);
        
        $this->filter->addNumericFilter('id_post');
        $this->filter->addDropDownFilter('id_category', array(1=>'Sea',2=>'Mountain'));
        $this->filter->addTextFilter('title');
        $this->filter->addDateFilter('date_add');
        $this->filter->addDateTimeFilter('datetime_publish');

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
3) In view file call filter component, for render html inputs
```php
<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>

<?= Yii::$app->filter->render($searchModel->filter->getFilters()); ?>

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
