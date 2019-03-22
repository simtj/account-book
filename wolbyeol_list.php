<?php
    include_once "header.php";

    $year = empty($_GET['to_year']) ? date("Y") : $_GET['to_year'] ;
    $month = empty($_GET['to_month']) ? date("n") : $_GET['to_month'] ;

    $where = "";
    $where .= "and `year`=".$year." ";
    $where .= "and `month`=".$month." ";

    $all_company_where = $year."-".sprintf('%02d',$month)."-"."31 23:59:59";
    $all_company = all_company("reg_date", $all_company_where, "<=");

    if ($all_company) {

        foreach ($all_company as $k => $v) {
            $sql = "select * from `wolbyeol` where 1=1 and company_idx='".$v['idx']."' and company='".$v['company']."'".$where." order by idx desc";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);

            if (isset($row['idx'])) {
                $result_row[$k]['company_idx'] = $v['idx'];
                $result_row[$k]['company'] = $v['company'];
                $result_row[$k]['unit_price'] = $row['unit_price'];                
                $result_row[$k]['breakfast'] = $row['breakfast'];
                $result_row[$k]['lunch'] = $row['lunch'];
                $result_row[$k]['dinner'] = $row['dinner'];
                $result_row[$k]['snack'] = $row['snack'];
                $result_row[$k]['special'] = $row['special'];
                $result_row[$k]['special_price'] = $row['special_price'];
                $result_row[$k]['total_price'] = $row['total_price'];
            } else {
                $result_row[$k]['company_idx'] = $v['idx'];
                $result_row[$k]['company'] = $v['company'];
                $result_row[$k]['unit_price'] = "0";   
                $result_row[$k]['breakfast'] = "0";
                $result_row[$k]['lunch'] = "0";
                $result_row[$k]['dinner'] = "0";
                $result_row[$k]['snack'] = "0";
                $result_row[$k]['special'] = "0";
                $result_row[$k]['special_price'] = "0";
                $result_row[$k]['total_price'] = "0";
            }
        }
    }
 
?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> 월별 리스트 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <form name="search_frm" action="wolbyeol_list.php" method="get">
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
                            월별 리스트
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
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>업체명</th>
                                        <th>아침</th>
                                        <th>점심</th>
                                        <th>저녁</th>
                                        <th>야식</th>
                                        <th>특식(금액)</th>
                                        <th>도시락합계</th>
                                        <th>총액(특식합계)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($result_row))  { ?>
                                        <?php foreach ($result_row as $k => $v) { ?>
                                        <tr>
                                                <td><a href="wolbyeol_view.php?company_idx=<?php echo $v['company_idx']?>&year=<?php echo $year?>&month=<?php echo $month?>"><?php echo $v['company']?></a></td>
                                                <td><?php echo $v['breakfast']?></td>
                                                <td><?php echo $v['lunch']?></td>
                                                <td><?php echo $v['dinner']?></td>
                                                <td><?php echo $v['snack']?></td>
                                                <td><?php echo $v['special']?></td>
                                                <td><?php echo $v['special_price']?></td>
                                                <td><?php echo $v['total_price']?></td>
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