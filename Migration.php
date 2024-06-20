<?php

include __DIR__ . '/Model.php';

$model = new Model();

$model->make_levels_table();
echo "levels table is ok \n";

echo "running levels seeds";
$model->add_level('⌚️🐶', 'watch dogs');
$model->add_level('🌟🐠', 'star fish');
$model->add_level('🌶🐶', 'hotdog');
echo "successfully \n";

$model->make_users_table();
