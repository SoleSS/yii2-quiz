<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model soless\quiz\models\QuizTest */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-test-view">

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
            /*[
                'attribute' => 'questions_list',
                'value' => function (\common\models\QuizTest $model) {
                    return '<pre>'. print_r($model->questions_list, 1).'</pre>';
                },
                'format' => 'html',
            ],*/
        ],
    ]) ?>

</div>

<div class="quiz-test-preview">
    <?php $form = ActiveForm::begin([
        'action' => ['/quiz-test/try'],
        'method' => 'POST',
    ]);
    $formModel = new \soless\quiz\models\QuizTestForm();
    $formModel->testId = $model->id; ?>
    <?php /** @var \soless\quiz\models\QuizQuestion $item */
    foreach ($model->questions as $index => $item) : ?>
        <div class="question-wrap">
            <div class="question-title">
                <?= $item->full_question ?>
            </div>
            <div class="answears-wrap">
                <?php if ($item->type === $item::TYPE_TEXT) : ?>
                    <?php echo $form->field($formModel, "answears[{$item->id}]")->textInput(); ?>
                <?php elseif ($item->type === $item::TYPE_RADIOS) : ?>
                    <?php echo $form->field($formModel, "answears[{$item->id}]")->radioList($item->answearsAsArray); ?>
                <?php elseif ($item->type === $item::TYPE_CHECKBOXES) : ?>
                    <?php echo $form->field($formModel, "answears[{$item->id}][]")->checkboxList($item->answearsAsArray); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?php echo $form->field($formModel, "testId")->hiddenInput()->label(false); ?>
        <?= Html::submitButton('Попробовать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
