<?php
    include_once "header.php";

    $year = empty($_GET['to_year']) ? date("Y") : $_GET['to_year'] ;
    $month = empty($_GET['to_month']) ? date("n") : $_GET['to_month'] ;
    $day = empty($_GET['to_day']) ? date("d") : $_GET['to_day'] ;

    $where = "";
    $where .= "and `year`=".$year." ";
    $where .= "and `month`=".$month." ";
    $where .= "and `day`=".$day." ";

    $all_company_where = $year."-".sprintf('%02d',$month)."-"."31 23:59:59";
    $all_company = all_company("reg_date", $all_company_where, "<=");

    if ($all_company) {
        foreach ($all_company as $k => $v) {
            $sql = "select * from `ilbyeol` where 1=1 and company_idx='".$v['idx']."' and company='".$v['company']."'".$where." order by idx desc";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);

            if (isset($row['idx'])) {
                $result_row[$k]['idx'] = $v['idx'];
                $result_row[$k]['company'] = $v['company'];
                $result_row[$k]['breakfast'] = $row['breakfast'];
                $result_row[$k]['lunch'] = $row['lunch'];
                $result_row[$k]['dinner'] = $row['dinner'];
                $result_row[$k]['snack'] = $row['snack'];
                $result_row[$k]['special'] = $row['special'];
                $result_row[$k]['special_price'] = $row['special_price'];
                $result_row[$k]['total_price'] = $row['total_price'];
                $result_row[$k]['button'] = "<button type=\"button\" class=\"btn btn-info\" onClick=\"_update('".$row['idx']."')\">수정</button>";
            } else {
                $result_row[$k]['idx'] = $v['idx'];
                $result_row[$k]['company'] = $v['company'];
                $result_row[$k]['breakfast'] = "0";
                $result_row[$k]['lunch'] = "0";
                $result_row[$k]['dinner'] = "0";
                $result_row[$k]['snack'] = "0";
                $result_row[$k]['special'] = "0";
                $result_row[$k]['special_price'] = "0";
                $result_row[$k]['total_price'] = "0";
                $result_row[$k]['button'] = "<button type=\"button\" class=\"btn btn-info\" onClick=\"_write('".$v['idx']."')\">수정</button>";
            }
        }
    }    

?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> 일별 리스트 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <form name="search_frm" action="ilbyeol_list.php" method="get">
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
                                <option value="<?php echo $i;?>" <?php if ($month == $i) { echo "selected"; } ?>  ><?php echo  $i;?></option>
                                <?php } ?>
                            </select>
                        </label>월
                        &nbsp;&nbsp;&nbsp;&nbsp;          
                        <label>
                            <select class="form-control input-sm" name="to_day" >
                                <?php for ($i=1; $i< 32; $i++) { ?>
                                <option value="<?php echo $i;?>" <?php if ($day == $i) { echo "selected"; } ?>  ><?php echo $i;?></option>
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
                            일별 리스트
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
                                        <col width="100">
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
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($result_row))  { ?>
                                        <?php foreach ($result_row as $k => $v) { ?>
                                        <tr>
                                                <td><?php echo $v['company']?></td>
                                                <td><?php echo $v['breakfast']?></td>
                                                <td><?php echo $v['lunch']?></td>
                                                <td><?php echo $v['dinner']?></td>
                                                <td><?php echo $v['snack']?></td>
                                                <td><?php echo $v['special']?></td>
                                                <td><?php echo $v['special_price']?></td>
                                                <td><?php echo $v['total_price']?></td>
                                                <td><?php echo $v['button']?></td>
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

            $("[name='to_day']").change(function() {
                $("[name='search_frm']").submit();
            })

        });

        function _write(company_idx) {
            location.href = 'ilbyeol_write.php?company_idx='+company_idx+'&to_year=<?php echo $year?>&to_month=<?php echo $month?>&to_day=<?php echo $day?>';
        }

        function _update(idx) {
            location.href = 'ilbyeol_update.php?idx='+idx;
        }
    </script>
<?php include_once "footer.php"; ?>    