# Advancedfilter For Yii2 GridView

Configuration

Add Filter component to application components
```php
 'components' => [
        'filter' => [
            'class' => 'vendor\advancedfilter\components\FilterComponent',
        ],
    ]
```
Usage
1) Define Property in Your SearchModel

```php
 class PostSearch extends Post{
     
    /**
     * @var \advancedfilter\src\base\Filter[]
     */  
    public $filters = array();

}
```
2) Use what you want filter, in your search function

```php
use advancedfilter\src\filters;

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
        
        $this->filters['title'] = new filters\TextFilter($this, 'title', $query);
        $this->filters['id_post'] = new filters\NumericFilter($this, 'id_post', $query);

        foreach ($this->filters as $key => $filter) {
            $query = $filter->executeFilter();
        }

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
3) In view file call filter component 
```php
<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>

<?php Yii::$app->filter->draw($searchModel->filters); ?>

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
