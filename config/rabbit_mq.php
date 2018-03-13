<?php

return [
    'class' => \yii\queue\amqp\Queue::class,
    'host' => 'localhost',
    'port' => 5672,
    'user' => 'guest',
    'password' => 'guest',
    'queueName' => 'queue',
];