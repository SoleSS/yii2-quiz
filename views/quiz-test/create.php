<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model soless\quiz\models\QuizTest */

$this->title = 'Добавить тест';
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
