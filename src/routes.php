<?php


// Routes

$app->get('/',\Action\CodeShowAction::class);

$app->post('/code/add',\Action\CodeAddAction::class)->setName("addCode");

$app->post('/code/delete',\Action\CodeDeleteAction::class)->setName('deleteCode');

$app->post('/code/checkout',\Action\CodeCheckOutAction::class)->setName('checkoutCode');