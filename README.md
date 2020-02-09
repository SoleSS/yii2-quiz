# yii2-quiz

## Installation

composer require --prefer-dist soless/yii2-quiz "*"

php yii migrate/up --migrationPath=@vendor/soless/yii2-quiz/migrations

add to config:
```
    'modules' => [
        'quiz' => [
            'class' => '\soless\quiz\Module',
        ]
    ],
```

## Available CRUD controllers:

