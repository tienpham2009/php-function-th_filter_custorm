<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="get">
    Chon ngay sinh tu: <input id="from" type="date" name="form" placeholder="yyyy/mm/dd" value="">
    den : <input id="to" type="date" name="to" placeholder="yyyy/mm/dd" value="">
    <input type="submit" id="submit" value="LOC">
</form>
<?php
$customerList = [
    "1" => [
        "name" => "Mai Văn Hoàn",
        "day_of_birth" => "1983/08/20",
        "address" => "Hà Nội",
        "profile" => "images/img1.jpg"],
    "2" => [
        "name" => "Nguyễn Văn Nam",
        "day_of_birth" => "1983/08/21",
        "address" => "Bắc Giang",
        "profile" => "images/img2.jpg"],
    "3" => [
        "name" => "Nguyễn Thái Hòa",
        "day_of_birth" => "1983/08/22",
        "address" => "Nam Định",
        "profile" => "images/img3.jpg"],
    "4" => [
        "name" => "Trần Đăng Khoa",
        "day_of_birth" => "1983/08/17",
        "address" => "Hà Tây",
        "profile" => "images/img4.jpg"],
    "5" => [
        "name" => "Nguyễn Đình Thi",
        "day_of_birth" => "1983/08/19",
        "address" => "Hà Nội",
        "profile" => "images/img5.jpg"]
];
$fromDate = null;
$toDate = null;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $fromDate = $_REQUEST["from"];
    $toDate = $_REQUEST["to"];
}
function searchByDate($customers, $fromDate, $toDate)
{
    if (empty($fromDate) || empty($toDate)) {
        return $customers;
    }

    $filteredCustomers = [];
    foreach ($customers as $customer) {
        if (strtotime($customer['day_of_birth']) < strtotime($fromDate))
            continue;
        if (strtotime($customer['day_of_birth']) > strtotime($toDate))
            continue;
        $filteredCustomers[] = $customer;
    }
    return $filteredCustomers;
}

$filteredCustomers = searchByDate($customerList, $fromDate, $toDate);
?>
<table border="0">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php foreach ($filteredCustomers as $index => $customer): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $customer['name']; ?></td>
            <td><?php echo $customer['day_of_birth']; ?></td>
            <td><?php echo $customer['address']; ?></td>
            <td>
                <div class="profile"><img src="<?php echo $customer['profile']; ?>"/></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
