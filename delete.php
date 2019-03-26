<?php
    include_once "common.php";

    $query = "select * from account where idx = :idx order by idx desc";
    $stmt = $connection->prepare($query);
    $stmt->execute([
        ':idx' => $idx
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $company = $row['company'];


    $sql = "delete from `account` where company = :company";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':company' => $company
    ]);

    alert_go_to("삭제 되었습니다.", "index.php");
?>