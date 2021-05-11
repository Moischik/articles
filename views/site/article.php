<?php

/*show articles*/

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var ActiveDataProvider $articlesProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;

echo ListView::widget([
    'dataProvider' => $articlesProvider,
    'itemView' => 'item-of-list',
]);
