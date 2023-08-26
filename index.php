<?php
$servername = "localhost";
$username = "root";
$password = "";

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$per_page_record = 5;

$start_from = ($page - 1) * $per_page_record;

try {
    $conn = new PDO("mysql:host=$servername;dbname=task", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT COUNT(*) FROM `employees`");
    $stmt->execute();
    $count = $stmt->fetch();
    $total_records = $count['COUNT(*)'];

    $total_pages = ceil($total_records / $per_page_record);

    $stmt = $conn->prepare("SELECT * FROM employees LIMIT $start_from, $per_page_record");
    $stmt->execute();
    $rs_result = $stmt->fetchAll();

    if (count($rs_result) == 0) {
        $page = 1;

        header("Location: ?page=$page");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if ($_POST['submit'] === "Add") {
            $Employee_name = $_POST['name'];
            $Employee_email = $_POST['email'];
            $Employee_address = $_POST['address'];
            $Employee_phone = $_POST['phone'];

            $stmt = $conn->prepare("INSERT INTO `employees`(`Employee_name`, `Employee_email`, `Employee_address`, `Employee_phone`) VALUES ('$Employee_name','$Employee_email','$Employee_address','$Employee_phone')");
            $stmt->execute();
        }

        if ($_POST['submit'] === "Delete" && !empty($_POST['id'])) {
            $Employee_id = explode(" ", $_POST['id']);

            $sql = "DELETE FROM `employees` WHERE ";
            for ($i = 0; $i < count($Employee_id); $i++) {
                $sql .= "`Employee_id` = $Employee_id[$i] ";
                if (!($i + 1 == count($Employee_id))) {
                    $sql .= "OR ";
                }
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        if ($_POST['submit'] === "Edit") {
            $Employee_id = $_POST['id'];
            $Employee_name = $_POST['name'];
            $Employee_email = $_POST['email'];
            $Employee_address = $_POST['address'];
            $Employee_phone = $_POST['phone'];

            $stmt = $conn->prepare("UPDATE `employees` SET `Employee_name`='$Employee_name',`Employee_email`='$Employee_email',`Employee_address`='$Employee_address',`Employee_phone`='$Employee_phone' WHERE `Employee_id` = $Employee_id");
            $stmt->execute();
        }

        header("Location: ?page=$page");
        exit;
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

include("html.php");
?>