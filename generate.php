<?php




// チェーンが持つ従業員の数を選択
// 従業員の給与範囲を選択
// 場所の数を入力
// 場所の郵便番号の範囲を設定
// 生成したいファイルのタイプを選択: HTML、JSON、TXT、または MarkDown。

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Restaurant Chains</title>
</head>

<body>
    <form action="download.php" method="post">
        

        <label for="locationCount">Number of Locations:</label>
        <input type="number" id="locationCount" name="locationCount" min="1" max="10" value="5">
        <br />

        <label for="minZip">Minimum Zip:</label>
        <input type="number" id="minZip" name="minZip" min="0" step="100">

        <label for="maxZip">Maximum Zip:</label>
        <input type="number" id="maxZip" name="maxZip" min="0" step="100">
        <br />

        <label for="employeeCount">Number of Employees:</label>
        <input type="number" id="employeeCount" name="employeeCount" min="1" max="10" value="5">
        <br />

        <label for="minSalary">Minimum Salary:</label>
        <input type="number" id="minSalary" name="minSalary" min="0" step="100">

        <label for="maxSalary">Maximum Salary:</label>
        <input type="number" id="maxSalary" name="maxSalary" min="0" step="100">
        <br />

        <label for="format">Download Format:</label>
        <select id="format" name="format">
            <option value="html">HTML</option>
            <option value="markdown">Markdown</option>
            <option value="json">JSON</option>
            <option value="txt">Text</option>
        </select>
        <br />

        <button type="submit">Generate</button>
    </form>
</body>

</html>