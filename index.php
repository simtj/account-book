<?
    include_once "header.php";

    $sql = "select * from account order by idx desc";
    $result = mysql_query($sql);
    

    while ($row = mysql_fetch_array($result)) {
        if ($row) {
            $rows[] = $row;
        }
    }
    
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> 거래처 관리 </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
    
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        거래처 목록
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
                                    <col width="500">
                                    <col width="500">
                                    <col width="500">
                                    <col width="100">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>업체명</th>
                                    <th>전화번호</th>
                                    <th>상호</th>
                                    <th>등록번호</th>
                                    <th>대표자성명</th>
                                    <th>사업장주소</th>
                                    <th>업태</th>
                                    <th>종목</th>
                                    <th>품명</th>
                                    <th>메일주소</th>
                                    <th>예금주</th>
                                    <th>예상일</th>
                                    <th>단가</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <? if (isset($rows))  { ?>
                                    <? foreach ($rows as $k => $v) { ?>
                                        <tr>
                                            <td><?=$v['company']?></td>
                                            <td><?=$v['phone_number']?></td>
                                            <td><?=$v['mutual']?></td>
                                            <td><?=$v['registration_number']?></td>
                                            <td><?=$v['ceo_name']?></td>
                                            <td><?=$v['business_address']?></td>
                                            <td><?=$v['business_conditions']?></td>
                                            <td><?=$v['company_stock']?></td>
                                            <td><?=$v['product']?></td>
                                            <td><?=$v['email']?></td>
                                            <td><?=$v['account_holder']?></td>
                                            <td><?=$v['expected_date']?></td>
                                            <td><?=$v['unit_price']?></td>
                                            <td>
                                                <button type="button" class="btn btn-info" onClick="update('<?=$v['idx']?>')">수정</button>
                                                <button type="button" class="btn btn-danger" onClick="fdelete('<?=$v['idx']?>')">삭제</button>
                                            </td>
                                        </tr>
                                    <? } ?>
                                    <? } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="paging_div"></div>

                        <!-- Button trigger modal -->
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="btn_modal">
                        추가
                        </button>
                        <!-- Modal -->
                        
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form name="frm" action="index_action.php" method="post" enctyppe="multipart/form-data" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_exit">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">공지사항</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>업체명</label>
                                        <input class="form-control" name="company" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>전화번호</label>
                                        <input class="form-control" name="phone_number" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>상호</label>
                                        <input class="form-control" name="mutual" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>등록번호</label>
                                        <input class="form-control" name="registration_number" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>대표자성명</label>
                                        <input class="form-control" name="ceo_name" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>사업장주소</label>
                                        <input class="form-control" name="business_address" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>업태</label>
                                        <input class="form-control" name="business_conditions" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>중목</label>
                                        <input class="form-control" name="company_stock" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>품명</label>
                                        <input class="form-control" name="product" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>메일주소</label>
                                        <input class="form-control" name="email" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>예금주</label>
                                        <input class="form-control" name="account_holder" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>예상일</label>
                                        <input class="form-control" name="expected_date" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label>단가</label>
                                        <input class="form-control" name="unit_price" maxlength="100">
                                    </div>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_close">닫기</button>
                                    <button type="button" class="btn btn-primary" id="btn_save">저장</button>
                                </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
    
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
        
        function update(idx) {
            location.href = 'update.php?idx='+idx;
        }

        function fdelete(idx) {
            location.href = 'delete.php?idx='+idx;
        }
        </script>
<? include_once "footer.php"; ?>    