<?php
// JSONファイルからデータを読み込む
$jsonData = file_get_contents('survey_data.json');
$data = json_decode($jsonData, true);

// CSVファイルのヘッダーを設定
$csvHeader = ['名前', 'Email', '肌質', '年齢', '性別'];

// CSV形式のデータを準備
$csvData = [];
foreach ($data as $entry) {
    $csvData[] = array_map('utf8_encode', [
        isset($entry['name']) ? utf8_encode($entry['name']) : '',
        isset($entry['email']) ? utf8_encode($entry['email']) : '',
        isset($entry['skin_type']) ? utf8_encode($entry['skin_type']) : '',
        isset($entry['age']) ? utf8_encode($entry['age']) : '',
        isset($entry['gender']) ? utf8_encode($entry['gender']) : ''
    ]);
}

// ファイル名を設定
$fileName = 'survey_data.csv';

// CSVファイルを作成してデータを書き込む
$fp = fopen($fileName, 'w');
fputcsv($fp, $csvHeader);
foreach ($csvData as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

// ダウンロードヘッダーを設定してファイルをダウンロードさせる
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
readfile($fileName);

// 作成したCSVファイルを削除
unlink($fileName);
?>
