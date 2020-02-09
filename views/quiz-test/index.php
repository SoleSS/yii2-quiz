<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel soless\quiz\models\QuizTestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тесты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'result_dates',
                'label' => 'Результаты',
                'format' => 'raw',
                'value' => function(\soless\quiz\models\QuizTest $item) {
                    $result = [];
                    foreach ($item->resultDates as $date) {
                        $result[] = '<a href="'. Url::toRoute(['/quiz-test/results', 'id' => $item->id, 'date' => $date]) .'" class="block badge badge-secondary">'. $date .'</a>';
                    }
                    return implode("\n", $result);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
