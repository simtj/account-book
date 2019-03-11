<?
    include_once "common.php";

    $year = empty($_GET['to_year']) ? date("Y") : $_GET['to_year'] ;
    $month = empty($_GET['to_month']) ? date("n") : $_GET['to_month'] ;
    $day = empty($_GET['to_day']) ? date("d") : $_GET['to_day'] ;

    $where = "";
    $where .= "and `year`=".$year." ";
    $where .= "and `month`=".$month." ";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <? include_once "sidebar.php"; ?>

        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> 월별 입력 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <form name="search_frm" action="wolbyeol_list.php" method="get">
                    <div class="col-sm-5">
                        <label>
                            <select class="form-control input-sm" name="to_year" >
                                <option value="2018" <? if ($year == "2018") { echo "selected"; } ?> >2018</option>
                                <option value="2019" <? if ($year == "2019") { echo "selected"; } ?> >2019</option>
                                <option value="2020" <? if ($year == "2020") { echo "selected"; } ?> ">2020</option>
                            </select>
                        </label>년
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <select class="form-control input-sm" name="to_month" >
                                <? for ($i=1; $i< 13; $i++) { ?>
                                <option value="<?=$i;?>" <? if ($month == $i) { echo "selected"; } ?>  ><?=$i;?></option>
                                <? } ?>
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
                            월별 입력
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
                                    <?  
                                        foreach (all_company() as $k => $v) {   
                                            $sql = "select * from `wolbyeol` where 1=1 and company_idx='".$v['idx']."' and company='".$v['company']."'".$where." order by idx desc";
                                            $result = mysql_query($sql);
                                            $row = mysql_fetch_array($result);
                                            
                                            if (isset($row['idx'])) {
                                    ?>
                                            <tr>
                                                <td><?=$v['company']?></td>
                                                <td><?=$row['breakfast']?></td>
                                                <td><?=$row['lunch']?></td>
                                                <td><?=$row['dinner']?></td>
                                                <td><?=$row['snack']?></td>
                                                <td><?=$row['special']?></td>
                                                <td><?=$row['special_price']?></td>
                                                <td><?=$row['total_price']?></td>
                                                <td><button type="button" class="btn btn-info" onClick="_update('<?=$row['idx']?>')">수정</button></td>
                                            </tr>
                                            <? } else { ?>
                                                <tr>
                                                <td><?=$v['company']?></td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td><button type="button" class="btn btn-info" onClick="_write('<?=$v['idx']?>')">수정</button></td>
                                            </tr>                                            
                                            <? } ?>
                                    <?  }  ?>
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

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

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

        function _write(company_idx) {
            location.href = 'wolbyeol_write.php?company_idx='+company_idx+'&to_year=<?=$year?>&to_month=<?=$month?>';
        }

        function _update(idx) {
            location.href = 'wolbyeol_update.php?idx='+idx;
        }
    </script>

</body>

</html>
