<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $title string */
/* @var $results array */
/* @var $totalResult float */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-test-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($results as $question) : ?>
        <div class="question-wrap row">
            <div class="title-wrap">
                <h2><?= $question['title'] ?></h2>
            </div>
            <div class="answears-wrap">
                <?php foreach ($question['answears'] as $answear) : ?>
                    <div class="answear-wrap <?= $answear['checked'] && $answear['status'] == \soless\quiz\models\QuizQuestion::STATUS_RIGHT ?
                        'alert alert-success' :
                        ($answear['checked'] && $answear['status'] == \soless\quiz\models\QuizQuestion::STATUS_WRONG ?
                            'alert alert-danger' :
                            ''
                        ) ?>">
                        <?= $answear['title'] ?> <?= $answear['checked'] ? "[{$answear['value']}]" : '' ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="row result-wrap">
        <h2>Общий результат: <?= $totalResult ?></h2>
    </div>
</div>

