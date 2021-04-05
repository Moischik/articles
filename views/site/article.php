<?php

/*show articles*/

use yii\widgets\ListView;

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;

echo ListView::widget([
    'dataProvider' => $articlesProvider,
    'itemView' => 'itemoflist',
]);
