<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model soless\quiz\models\QuizQuestion */

$this->title = 'Изменить вопрос: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы для тестов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="quiz-question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
