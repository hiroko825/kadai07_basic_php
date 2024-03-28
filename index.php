<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <h2>アンケート</h2>
        <form id="surveyForm" action="write.php " method="POST"> 
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" autocomplete="name" required><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" autocomplete="email" required><br>
            
            <label for="skin_type">肌質:</label>
            <select id="skin_type" name="skin_type" autocomplete="skin-type" required>
                <option value="普通肌">普通肌</option>
                <option value="混合肌">混合肌</option>
                <option value="乾燥肌">乾燥肌</option>
                <option value="油脂肌">油脂肌</option>
            </select><br>
            
            <label for="age">年齢:</label>
            <select id="age" name="age" autocomplete="age" required>
                <option value="10代">10代</option>
                <option value="20代">20代</option>
                <option value="30代">30代</option>
                <option value="40代">40代</option>
                <option value="50代以上">50代以上</option>
            </select><br>
            
            <label for="gender">性別:</label>
            <select id="gender" name="gender" autocomplete="gender" required>
                <option value="男性">男性</option>
                <option value="女性">女性</option>
                <option value="回答不可">回答不可</option>
            </select><br>

            <label for="like">好みのメイク:</label>
            <select id="like" name="like" autocomplete="like" required>
                <option value="ナチュラル">ナチュラル</option>
                <option value="フォーマル">フォーマル</option>
                <option value="トレンド">トレンド</option>
            </select><br>
            <input type="submit" value="送信">
        </form>
        <h3>
            アンケートにご協力いただきありがとうございました！
        </h3>
    </div>
</body>
</html>
