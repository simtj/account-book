<?
    include_once "common.php";

    $sql = "select * from closing_account order by idx desc";
    $result = mysql_query($sql);
    

    while ($row = mysql_fetch_array($result)) {
        $rows[] = $row;
    }
    

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
           
        });
    </script>

</body>

</html>
