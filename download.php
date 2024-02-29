<?php

use Helpers\RandomGenerator;

spl_autoload_extensions(".php");
spl_autoload_register();

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

// POSTリクエストからパラメータを取得
$chainCount = $_POST['chainCount'] ?? 5;
$locationCount = $_POST['locationCount'] ?? 5;
$minZip = $_POST['minZip'] ?? 5;
$maxZip = $_POST['maxZip'] ?? 5;
$employeeCount = $_POST['employeeCount'] ?? 5;
$minSalary = $_POST['minSalary'] ?? 5;
$maxSalary = $_POST['maxSalary'] ?? 5;


$format = $_POST['format'] ?? 'html';

// パラメータが正しい形式であることを確認
$chainCount = (int)$chainCount;

$locationCount = (int)$locationCount;
$minZip = (int)$minZip;
$maxZip = (int)$maxZip;
$employeeCount = (int)$employeeCount;
$minSalary = (int)$minSalary;
$maxSalary = (int)$maxSalary;

echo($format);


// 検証
if (is_null($chainCount) ||is_null($locationCount) || is_null($minZip) ||is_null($maxZip) ||is_null($employeeCount) ||is_null($minSalary) ||is_null($maxSalary) ||is_null($format)) {
    exit('Missing parameters.');
}

// if (!is_numeric($count) || $count < 1 || $count > 100) {
//     exit('Invalid count. Must be a number between 1 and 100.');
// }

$allowedFormats = ['json', 'txt', 'html', 'markdown'];
if (!in_array($format, $allowedFormats)) {
    exit('Invalid type. Must be one of: ' . implode(', ', $allowedFormats));
}


// ユーザーを生成
// $users = RandomGenerator::users($count, $count);

// レストランチェーンの生成
$chains = RandomGenerator::restaurantChains( $chainCount,
$locationCount,
$minZip,$maxZip,
$employeeCount,
$minSalary,
$maxSalary);

// echo($chains);

// チェーンが持つ従業員の数を選択
// 従業員の給与範囲を選択
// 場所の数を入力
// 場所の郵便番号の範囲を設定
// 生成したいファイルのタイプを選択: HTML、JSON、TXT、または MarkDown。

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="chains.md"');
    foreach ($chains as $chain) {
        echo $chain->toMarkdown();
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="chains.json"');
    $chainsArray = array_map(fn($chain) => $chain->toArray(), $chains);
    echo json_encode($chainsArray);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="chains.txt"');
    foreach ($chains as $chain) {
        echo $chain->toString();
    }
} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
    foreach ($chains as $chain) {
        echo $chain->toHTML();
    }
}

?>