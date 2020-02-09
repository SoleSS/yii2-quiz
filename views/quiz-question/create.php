<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model soless\quiz\models\QuizQuestion */

$this->title = 'Добавить вопрос';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы для тестов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
