<?php
    include_once "header.php";

    $_company = get_company("idx", $company_idx); 
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> 일별 입력 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
    
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            일별 입력
                        </div>
                        <div class="panel-body">
                        
                            <form name="frm" action="ilbyeol_action.php" method="post" enctyppe="multipart/form-data" >                             
                                <input type="hidden" name="mode" value="w">
                                <input type="hidden" name="company_idx" value="<?php echo $_company['idx']?>">
                                <input type="hidden" name="year" value="<?php echo $to_year?>">
                                <input type="hidden" name="month" value="<?php echo $to_month?>">
                                <input type="hidden" name="day" value="<?php echo $to_day?>">

                                <div class="form-group">
                                    <label>업체명</label>
                                    <input class="form-control" name="company" value="<?php echo $_company['company']?>" maxlength="100" disabled>
                                </div>
                                <div class="form-group">
                                    <label>아침</label>
                                    <input class="form-control" name="breakfast" value="0" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>점심</label>
                                    <input class="form-control" name="lunch" value="0" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>저녁</label>
                                    <input class="form-control" name="dinner" value="0" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>야식</label>
                                    <input class="form-control" name="snack" value="0" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>특식</label>
                                    <input class="form-control" name="special" value="0" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>특식(금액)</label>
                                    <input class="form-control" name="special_price" value="0" maxlength="100">
                                </div>

                                <button type="button" class="btn btn-primary" id="btn_save">수정</button>
                                
                            </form>
        
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
        });
    </script>
<?php include_once "footer.php"; ?>    
 