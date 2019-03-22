<?php
    include_once "header.php";

    $year = empty($_GET['to_year']) ? date("Y") : $_GET['to_year'] ;
    $month = empty($_GET['to_month']) ? date("n") : $_GET['to_month'] ;

    $where = "";
    $where .= " and `year`='".$year."' ";
    $where .= " and `month`='".$month."' ";

    $all_company_where = $year."-".sprintf('%02d',$month)."-"."31 23:59:59";
    $all_company = all_company("reg_date", $all_company_where, "<=");

    if ($all_company) {

        foreach ($all_company as $k => $v) {
            $sql = "select * from `gyeolsan` where 1=1 and company_idx='".$v['idx']."' and company='".$v['company']."'".$where." order by idx desc";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);

            if (isset($row['idx'])) {
                $result_row[$k]['company_idx'] = $v['idx'];
                $result_row[$k]['company'] = $v['company'];
                $result_row[$k]['unit_price'] = $row['unit_price'];
                $result_row[$k]['accounts_receivable'] = $row['accounts_receivable'];
                $result_row[$k]['sales'] = $row['sales'];
                $result_row[$k]['supply_value'] = $row['supply_value'];
                $result_row[$k]['tax_amount'] = $row['tax_amount'];
                $result_row[$k]['bill_amount'] = $row['bill_amount'];
                $result_row[$k]['accounts_alloy'] = $row['accounts_alloy'];
                $result_row[$k]['deposit'] = $row['deposit'];
                $result_row[$k]['deposit_date'] = $row['deposit_date'];                
            } else {
                $result_row[$k]['company_idx'] = $v['idx'];
                $result_row[$k]['company'] = $v['company'];
                $result_row[$k]['unit_price'] = 0;
                $result_row[$k]['accounts_receivable'] = 0;
                $result_row[$k]['sales'] = 0;
                $result_row[$k]['supply_value'] = 0;
                $result_row[$k]['tax_amount'] = 0;
                $result_row[$k]['bill_amount'] = 0;
                $result_row[$k]['accounts_alloy'] = 0;
                $result_row[$k]['deposit'] = 0;
                $result_row[$k]['deposit_date'] = 0;
            }
        }
    }    
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> 결산 관리 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <form name="search_frm" action="gyeolsan.php" method="get">
                    <div class="col-sm-5">
                        <label>
                            <select class="form-control input-sm" name="to_year" >
                                <option value="2018" <?php if ($year == "2018") { echo "selected"; } ?> >2018</option>
                                <option value="2019" <?php if ($year == "2019") { echo "selected"; } ?> >2019</option>
                                <option value="2020" <?php if ($year == "2020") { echo "selected"; } ?> ">2020</option>
                            </select>
                        </label>년
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <select class="form-control input-sm" name="to_month" >
                                <?php for ($i=1; $i< 13; $i++) { ?>
                                <option value="<?php echo $i;?>" <?php if ($month == $i) { echo "selected"; } ?>  ><?php echo $i;?></option>
                                <?php } ?>
                            </select>
                        </label>월                        
                    </div>
                </form>
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
                                <?php if (isset($result_row))  { ?>
                                    <?php foreach ($result_row as $k => $v) { ?>
                                        <tr>
                                            <td><?php echo $v['company']?></td>
                                            <td><?php echo $v['unit_price']?></td>
                                            <td><?php echo $v['accounts_receivable']?></td>
                                            <td><?php echo $v['sales']?></td>
                                            <td><?php echo $v['supply_value']?></td>
                                            <td><?php echo $v['tax_amount']?></td>
                                            <td><?php echo $v['bill_amount']?></td>
                                            <td><?php echo $v['accounts_alloy']?></td>
                                            <td><?php echo $v['deposit']?></td>
                                            <td><?php echo $v['deposit_date']?></td>                     
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
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
            $("[id='btn_save']").click(function() {
                $("[name='frm']").submit();
            })

            $("[name='to_year']").change(function() {
                $("[name='search_frm']").submit();
            })

            $("[name='to_month']").change(function() {
                $("[name='search_frm']").submit();
            })            

        });

    </script>
<?php include_once "footer.php"; ?>