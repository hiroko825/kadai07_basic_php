<!DOCTYPE html>
<html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを受け取る
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $skinType = $_POST['skin_type'] ?? '';
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $like = $_POST['like'] ?? '';

    // 受け取ったデータをJSON形式で保存する
    $newData = array(
        'name' => $name,
        'email' => $email,
        'skin_type' => $skinType,
        'age' => $age,
        'gender' => $gender,
        'like' => $like
    );

    // 既存のデータを取得
    $jsonData = file_get_contents('survey_data.json');
    $data = json_decode($jsonData, true);

    // 新しいデータを追加
    $data[] = $newData;

    // ファイルに書き込み
    $result = file_put_contents('survey_data.json', json_encode($data));
    if ($result === false) {
        echo "<p>ファイルの書き込みに失敗しました。</p>";
        exit;
    }

    // リダイレクト
    header('Location: index.php');
    exit();
} else {
    // フォームが正しく入力されていない場合はエラーメッセージを表示
    echo "<p>フォームが正しく入力されていません。</p>";
    echo "<p><a href='index.php'>戻る</a></p>";
}
?>
</html>
