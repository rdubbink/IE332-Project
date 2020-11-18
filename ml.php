<?php 
require_once __DIR__ . '/vendor/autoload.php';

use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

$samples = [[1, 3, 1], [1, 4, 2], [2, 4, 1], [3, 1, 4], [4, 1, 4], [4, 2, 1]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new SVC(Kernel::LINEAR, $cost = 1000);
$classifier->train($samples, $labels);

var_dump($classifier->predict([1, 2, 2]));
?>