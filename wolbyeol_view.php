
<?php
    include_once "header.php";

    $_company = all_company("idx", $company_idx);


    $result_total_row['total_breakfast'] = 0;
    $result_total_row['total_lunch'] = 0;
    $result_total_row['total_dinner'] = 0;
    $result_total_row['total_snack'] = 0;
    $result_total_row['total_special'] = 0;
    $result_total_row['total_special_price'] = 0;

    for ($i=1; $i<32; $i++) {
        $sql = "select * from `ilbyeol` where company_idx = :company_idx and year = :year and month = :month and day = :day";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':company_idx' => $company_idx,
            ':year' => $year,
            ':month' => $month,
            ':day' => $i
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (is_array($row)) {
            $result_row[$i]['day'] = $i;
            $result_row[$i]['breakfast'] = ($row['breakfast'] == 0) ? "" : $row['breakfast'];
            $result_row[$i]['lunch'] = ($row['lunch'] == 0) ? "" : $row['lunch'];
            $result_row[$i]['dinner'] = ($row['dinner'] == 0) ? "" : $row['dinner'];
            $result_row[$i]['snack'] = ($row['snack'] == 0) ? "" : $row['snack'];
            $result_row[$i]['special'] = ($row['special'] == 0) ? "" : $row['special'];
            $result_row[$i]['special_price'] = ($row['special_price'] == 0) ? "" : $row['special_price'];

            if ($row['breakfast']) $result_total_row['total_breakfast'] += $row['breakfast'];
            if ($row['lunch']) $result_total_row['total_lunch'] += $row['lunch'];
            if ($row['dinner']) $result_total_row['total_dinner'] += $row['dinner'];
            if ($row['snack']) $result_total_row['total_snack'] += $row['snack'];
            if ($row['special']) $result_total_row['total_special'] += $row['special'];
            if ($row['special_price']) $result_total_row['total_special_price'] += $row['special_price'];

        } else {
            
            $result_row[$i]['day'] = $i;
            $result_row[$i]['breakfast'] = "";
            $result_row[$i]['lunch'] = "";
            $result_row[$i]['dinner'] = "";
            $result_row[$i]['snack'] = "";
            $result_row[$i]['special'] = "";
            $result_row[$i]['special_price'] = "";



        }
    }
?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> 월별 상세 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $_company[0]['company'];?>
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
                                        
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>날짜</th>
                                        <th>아침</th>
                                        <th>점심</th>
                                        <th>저녁</th>
                                        <th>야식</th>
                                        <th>특식(금액)</th>
                                        <th>기타</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result_row as $k => $v) { ?>
                                        <tr>
                                            <td><?php echo $v['day']?></td>
                                            <td><?php echo $v['breakfast']?></td>
                                            <td><?php echo $v['lunch']?></td>
                                            <td><?php echo $v['dinner']?></td>
                                            <td><?php echo $v['snack']?></td>
                                            <td>
                                                <?php echo $v['special']?>
                                                <?php if ($v['special']) { ?>
                                                (<?php echo $v['special_price']?>)
                                                <?php } ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>수량</td>
                                            <td><?php echo $result_total_row['total_breakfast']?></td>
                                            <td><?php echo $result_total_row['total_lunch']?></td>
                                            <td><?php echo $result_total_row['total_dinner']?></td>
                                            <td><?php echo $result_total_row['total_snack']?></td>
                                            <td><?php echo $result_total_row['total_special']?></td>
                                            <td><?php echo $result_total_row['total_breakfast']+$result_total_row['total_lunch']+$result_total_row['total_dinner']+$result_total_row['total_snack']+$result_total_row['total_special']?></td>
                                        </tr>
                                        <tr>
                                            <td>단가</td>
                                            <td><?php echo $_company[0]['unit_price']?></td>
                                            <td><?php echo $_company[0]['unit_price']?></td>
                                            <td><?php echo $_company[0]['unit_price']?></td>
                                            <td><?php echo $_company[0]['unit_price']?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>       
                                        <tr>
                                            <td>소계</td>
                                            <td><?php echo $_company[0]['unit_price']*$result_total_row['total_breakfast']?></td>
                                            <td><?php echo $_company[0]['unit_price']*$result_total_row['total_lunch']?></td>
                                            <td><?php echo $_company[0]['unit_price']*$result_total_row['total_dinner']?></td>
                                            <td><?php echo $_company[0]['unit_price']*$result_total_row['total_snack']?></td>
                                            <td></td>
                                            <td>
                                            <?php
                                               $_total = ($_company[0]['unit_price']*$result_total_row['total_breakfast'])+($_company[0]['unit_price']*$result_total_row['total_lunch'])+($_company[0]['unit_price']*$result_total_row['total_dinner'])+($_company[0]['unit_price']*$result_total_row['total_snack']);
                                               echo $_total;
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>공급가액</td>
                                             <td colspan="6" >
                                             <?php
                                                echo floor($_total/1.1);
                                             ?>
                                             </td>
                                        <tr>
                                        <tr>
                                             <td>부가세</td>
                                             <td colspan="6" ><?php echo $_total-floor($_total/1.1)?></td>
                                        <tr>
                                        <tr>
                                             <td>미수금</td>
                                             <td colspan="6" ></td>
                                        <tr>           
                                        <tr>
                                             <td>합계금액</td>
                                             <td colspan="6" ><?php echo floor($_total/1.1)+($_total-floor($_total/1.1))?></td>
                                        <tr>             
                                        <tr>
                                             <td>계좌안내</td>
                                             <td colspan="6" ></td>
                                        <tr>                                                                                                
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

    <script>
        $(function() {
              

        });

    </script>
<?php include_once "footer.php"; ?>    