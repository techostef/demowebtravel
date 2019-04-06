<div class="card">
   
    <div class="card-header">
        <strong>Permission</strong>
    </div> 
    <style>
    .form-group input[type="checkbox"] {
        display: none;
    }

    .form-group input[type="checkbox"] + .btn-group > label span {
        width: 20px;
    }

    .form-group input[type="checkbox"] + .btn-group > label span:first-child {
        display: none;
    }
    .form-group input[type="checkbox"] + .btn-group > label span:last-child {
        display: inline-block;   
    }

    .form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
        display: inline-block;
    }
    .form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
        display: none;   
    }
    </style>
    <div class="card-body card-block">
        <div class="row form-group" style="margin-left: 10px;">
            <div class="form-inline" >
                <label>Search</label>
                <input style="margin-left: 10px;" id="searchlist" class="form-control" placeholder="Search">
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Access</th>
                    <th>Allow
                        <div class="pull-right">
                            <input id="checkall" type="checkbox" style="cursor:pointer"> <label for="checkall" style="cursor:pointer">check all</label>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <input value="{{$id}}" type="hidden" name="id">
                <?php 
                $list = array();
                $value = array();
                foreach($data as $row){
                    array_push($list,$row['name']);
                    array_push($value,$row['code']);
                }
                ?>
                @foreach($permission as $row)
                <?php 
                $checked = "";
                
                $index = array_search($row,$list);
                if($index>=0&&gettype($index)=='integer'){
                    if($value[$index]==1){
                        $checked = "checked";
                        
                    }
                }
                ?>
                <tr class="fancycheckbox">
                    <input type="hidden" name="list[]" value="{{$row}}"/>

                    <td><?php echo ucwords(str_replace("_"," ",$row))?></td>
                    <td>
                        <div class="form-group">
                            <input type="checkbox" {{$checked}} class='checkboxaccess' name="access[]" value="{{$row}}" id="fancy-checkbox-default-{{$row}}" autocomplete="off" />
                            <div class="btn-group">
                                <label for="fancy-checkbox-default-{{$row}}" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span> </span>
                                </label>
                                <label for="fancy-checkbox-default-{{$row}}" class="btn btn-primary active">
                                    Access
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Submit
        </button>
    </div>
</div>
<script>
    var searchlist = $("#searchlist");
    var checkall = $("#checkall");
    var checkboxaccess = $(".checkboxaccess");
    var fancycheckbox = $(".fancycheckbox");
    var val;
    checkall.click(function(){
        if($(this).prop("checked")==true){
            checkboxaccess.each(function(){
                $(this).prop("checked",true);
            })
        }else{
            checkboxaccess.each(function(){
                $(this).prop("checked",false);
            })
        }
    })
    searchlist.keyup(function(){
        val = $(this).val();
        if(val==""){
            fancycheckbox.each(function(){
                $(this).show();
            })
            return false;
        }
        fancycheckbox.each(function(){
            if($(this).find("td").eq(0).text().toLowerCase().indexOf(val)>=0){
                $(this).show();
            }else{
                $(this).hide();
            }
        })
    })
</script>