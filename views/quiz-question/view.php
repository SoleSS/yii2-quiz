<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model soless\quiz\models\QuizQuestion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы для тестов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'full_question:html',
            'question_category_id',
            [
                'attribute' => 'answears',
                'value' => function (\soless\quiz\models\QuizQuestion $model) {
                    return '<pre>'. print_r($model->answears, 1).'</pre>';
                },
                'format' => 'html',
            ],
            'value',
        ],
    ]) ?>

</div>
