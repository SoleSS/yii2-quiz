<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model soless\quiz\models\QuizTest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(\mihaildev\ckeditor\CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'basic',
            'inline' => false,
            'height' => '200px',
            'allowedContent' => false,
            'removePlugins' => 'image',
        ]),
    ]); ?>

    <?= $form->field($model, 'questions_list')->widget(\unclead\multipleinput\MultipleInput::class, [
        //'max' => 4,
        'min' => 1,
        'addButtonPosition' => \unclead\multipleinput\MultipleInput::POS_FOOTER,
        'columns' => [
            [
                'name' => 'question_id',
                'title' => false,
                'type'  => 'dropDownList',
                'items' => \soless\quiz\models\QuizQuestion::asArray(),
            ],
            [
                'name' => 'status',
                'title' => false,
                'type'  => 'dropDownList',
                'items' => [
                    \soless\quiz\models\QuizTest::QUESTION_STATUS_ENABLED => 'Используется',
                    \soless\quiz\models\QuizTest::QUESTION_STATUS_DISABLED => 'Не используется'
                ],
            ],
        ]
    ]);
    ?>

    <?= $form->field($model, 'solve_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
