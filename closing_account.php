<?
    include_once "header.php";

    $sql = "select * from `closing_account` order by idx desc";
    $result = mysql_query($sql);
    

    while ($row = mysql_fetch_array($result)) {
        $rows[] = $row;
    }
    
    
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> 결산 관리 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
    
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        결산 목록
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="notice_tbl">
                                <colgroup>
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>업체명</th>
                                    <th>단가</th>
                                    <th>미수금</th>
                                    <th>순매출</th>
                                    <th>공금가액</th>
                                    <th>세액</th>
                                    <th>계산서금액</th>
                                    <th>미수포함금</th>
                                    <th>입금액</th>
                                    <th>입급날짜</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? if (isset($rows))  { ?>
                                    <? foreach ($rows as $k => $v) { ?>
                                        <tr>
                                            <td><?=$v['company']?></td>
                                            <td><?=$v['unit_price']?></td>
                                            <td><?=$v['accounts_receivable']?></td>
                                            <td><?=$v['sales']?></td>
                                            <td><?=$v['supply_value']?></td>
                                            <td><?=$v['tax_amount']?></td>
                                            <td><?=$v['bill_amount']?></td>
                                            <td><?=$v['accounts_alloy']?></td>
                                            <td><?=$v['deposit']?></td>
                                            <td><?=$v['deposit_date']?></td>                     
                                        </tr>
                                    <? } ?>
                                <? } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="paging_div"></div>
                    </div>
                    </div>
                </div>
            </div>                
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<? include_once "footer.php"; ?>