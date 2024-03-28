<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>結果</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>結果</h2>
    <table>
        <tr>
            <th>名前</th>
            <th>Email</th>
            <th>肌質</th>
            <th>年齢</th>
            <th>性別</th>
            <th>好みのメイク</th>
        </tr>
        <?php
        // アンケート結果を表示する処理
        $jsonData = file_get_contents('survey_data.json');
        $data = json_decode($jsonData, true);

        // バリデーションとフィルタリング
        $filteredData = array_filter($data, function($entry) {
            // 必要な条件に基づいてバリデーションを行う
            return !empty($entry['name']) && !empty($entry['email']) && !empty($entry['skin_type']);
        });

        foreach ($filteredData as $row) {
            echo "<tr>";
            // 表の各行のデータを表示
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['skin_type']}</td>";
            echo "<td>" . (isset($row['age']) ? $row['age'] : "") . "</td>";
            echo "<td>" . (isset($row['gender']) ? $row['gender'] : "") . "</td>";
            echo "<td>" . (isset($row['like']) ? $row['like'] : "") . "</td>";
            echo "</tr>";
        }

        // JavaScriptに渡すためにデータをカウントする
        $skinTypeCounts = array_count_values(array_column($filteredData, 'skin_type'));
        $ageCounts = array_count_values(array_column($filteredData, 'age'));
        $genderCounts = array_count_values(array_column($filteredData, 'gender'));
        ?>
    </table>
    <!-- Chart.jsでのグラフ描画用のキャンバス -->
    <div class="chart-container">
    <canvas id="chartContainer">肌質</canvas>
    <canvas id="ageChartContainer"></canvas>
    <canvas id="genderChartContainer"></canvas>
</div>

<div class="total-respondents">
        回答者総数： <?php echo count($filteredData); ?> 人
    </div>
    
<script>
    // JavaScriptによるグラフ描画部分
    var skinTypeCounts = <?php echo json_encode($skinTypeCounts); ?>;
    var ageCounts = <?php echo json_encode($ageCounts); ?>;
    var genderCounts = <?php echo json_encode($genderCounts); ?>;

    // 合計を計算
    var total = Object.values(skinTypeCounts).reduce((a, b) => a + b, 0);

    // ラベルとデータを生成
    var skinTypeLabels = Object.keys(skinTypeCounts).map(label => label + ': ' + ((skinTypeCounts[label] / total) * 100).toFixed(1) + '%');
    var skinTypeData = Object.values(skinTypeCounts);

    var skinTypeChart = new Chart(document.getElementById('chartContainer').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: skinTypeLabels,
        datasets: [{
            label: '肌質',
            data: Object.values(skinTypeCounts),
        }]
    },
    options: {
        responsive: false,
        plugins: {
            legend: {
                display: true,
                position: 'right'
            },
            title: {
                display: true,
                text: '肌質'
            }
        }
    }
});

    // 合計を計算
    var total = Object.values(ageCounts).reduce((a, b) => a + b, 0);

    // ラベルとデータを生成
    var ageLabels = Object.keys(ageCounts).map(label => label + ': ' + ((ageCounts[label] / total) * 100).toFixed(1) + '%');
    var ageData = Object.values(ageCounts);
    
    var ageChart = new Chart(document.getElementById('ageChartContainer').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: ageLabels,
        datasets: [{
            label: '年齢',
            data: Object.values(ageCounts),
        }]
    },
    options: {
        responsive: false,
        plugins: {
            legend: {
                display: true,
                position: 'right'
            },
            title: {
                display: true,
                text: '年齢'
            }
        }
    }
});

    // 合計を計算
    var total = Object.values(genderCounts).reduce((a, b) => a + b, 0);

    // ラベルとデータを生成
    var genderLabels = Object.keys(genderCounts).map(label => label + ': ' + ((genderCounts[label] / total) * 100).toFixed(1) + '%');
    var genderData = Object.values(genderCounts);

    var genderChart = new Chart(document.getElementById('genderChartContainer').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: genderLabels,
        datasets: [{
            label: '性別',
            data: Object.values(genderCounts),
        }]
    },
    options: {
        responsive: false,
        plugins: {
            legend: {
                display: true,
                position: 'right'
            },
            title: {
                display: true,
                text: '性別'
            }
        }
    }
});
</script>
</body>
</html>