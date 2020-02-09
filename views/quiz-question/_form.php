<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model soless\quiz\models\QuizQuestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_question')->widget(\mihaildev\ckeditor\CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'basic',
            'inline' => false,
            'height' => '100px',
            'allowedContent' => false,
            'removePlugins' => 'image',
        ]),
    ]); ?>

    <?= $form->field($model, 'question_category_id')->dropDownList(\soless\quiz\models\QuizQuestionCategory::asArray()) ?>

    <?= $form->field($model, 'type')->dropDownList(\soless\quiz\models\QuizQuestion::TYPE_TXT) ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'answers')->widget(\unclead\multipleinput\MultipleInput::class, [
        //'max' => 4,
        'min' => 2,
        'columns' => [
            [
                'name' => 'title',
                'title' => 'Ответ',
            ],
            [
                'name' => 'status',
                'title' => 'Признак',
                'type'  => 'dropDownList',
                'defaultValue' => 0,
                'items' => [
                    \soless\quiz\models\QuizQuestion::STATUS_WRONG => 'Не верный',
                    \soless\quiz\models\QuizQuestion::STATUS_RIGHT => 'Верный',
                ]
            ],
            [
                'name' => 'value',
                'title' => 'Цена ответа (%)',
            ],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<style>
    .list-cell__id, .list-cell__question_id {
        width: 100px;
    }
    .list-cell__status {
        width: 200px;
    }
    .list-cell__type {
        width: 300px;
    }
    .list-cell__value {
        width: 100px;
    }
</style>