<?php
    include_once "header.php";

    $sql = "select * from `ilbyeol` where idx = '{$idx}' order by idx desc";
    $result = mysql_query($sql);
    

    $row = mysql_fetch_array($result);
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
                                
                                <input type="hidden" name="idx" value="<?php=$row['idx']?>">
                                <input type="hidden" name="mode" value="u">
                                <input type="hidden" name="company_idx" value="<?php=$row['company_idx']?>">
                                <input type="hidden" name="year" value="<?php=$row['year']?>">
                                <input type="hidden" name="month" value="<?php=$row['month']?>">
                                <input type="hidden" name="day" value="<?php=$row['day']?>">

                                <div class="form-group">
                                    <label>업체명</label>
                                    <input class="form-control" name="company" value="<?php=$row['company']?>" maxlength="100" disabled>
                                </div>
                                <div class="form-group">
                                    <label>아침</label>
                                    <input class="form-control" name="breakfast" value="<?php=$row['breakfast']?>" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>점심</label>
                                    <input class="form-control" name="lunch" value="<?php=$row['lunch']?>" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>저녁</label>
                                    <input class="form-control" name="dinner" value="<?php=$row['dinner']?>" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>야식</label>
                                    <input class="form-control" name="snack" value="<?php=$row['snack']?>" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>특식</label>
                                    <input class="form-control" name="special" value="<?php=$row['special']?>" maxlength="100">
                                </div>
                                <div class="form-group">
                                    <label>특식(금액)</label>
                                    <input class="form-control" name="special_price" value="<?php=$row['special_price']?>" maxlength="100">
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