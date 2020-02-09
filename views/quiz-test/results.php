<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $quiz \soless\quiz\models\QuizTest */
/* @var $results \soless\quiz\models\QuizResult[] */


$this->title = 'Результаты теста';
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-results-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="quiz-info-wrap">
        <h2 class="title-wrap"><?= $quiz->title ?></h2>
        <div class="description-wrap"><?= $quiz->description ?></div>
    </div>

    <?php if (!empty($results)) : ?>
    <div class="results-wrap">
        <?php foreach ($results as $i => $result) : ?>
            <div class="result-wrap">
                <?= $i+1 ?>. <?= $result->user->name ?? $result->user->username ?> [<?= $result->result ?>]
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

