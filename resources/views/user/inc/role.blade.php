<link rel="stylesheet" type="text/css" href="{{asset('css/kendo.default.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/kendo.common.min.css')}}" />
<script type="text/javascript" src="{{asset('js/kendo.all.min.js')}}"></script>

<div class="card">
    <div class="card-header">
        <strong>User Access Roll :</strong>
    </div>

    <div class="card-body card-block" id="roll">
        <div class="box-body" >
            <div id="treeview" data-menu="<?php
            if(isset($menu)&&is_array($menu)==true){
                foreach ($menu as $i){
                    foreach ($i as $o=>$value){
                        echo $value.",";
                    }
                }
            }
            ?>"></div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($){
        $("#treeview").kendoTreeView({
            checkboxes: {
                checkChildren: true,
                template: "<input type='checkbox' #= item.check# name='menu[]' value='#= item.value #'  />"

            },
            check: onCheck,
            dataSource: [
                <?php foreach ($role as $parent => $v_parent): ?>
                <?php if (is_array($v_parent)): ?>
                <?php foreach ($v_parent as $parent_id => $v_child): ?>
                {
                    id: "", text: "<?php echo $parent; ?>", value: "<?php
                    if (!empty($parent_id)) {
                        echo $parent_id;
                    }
                    ?>", expanded: false, items: [
                    <?php foreach ($v_child as $child => $v_sub_child) : ?>
                    <?php if (is_array($v_sub_child)): ?>
                    <?php foreach ($v_sub_child as $sub_chld => $v_sub_chld): ?>
                    {
                        id: "", text: "<?php echo $child; ?>", value: "<?php
                        if (!empty($sub_chld)) {
                            echo $sub_chld;
                        }
                        ?>", expanded: false, items: [
                        <?php foreach ($v_sub_chld as $sub_chld_name => $sub_chld_id): ?>
                        {
                            id: "", text: "<?php echo $sub_chld_name; ?>",<?php
                            if (!empty($roll[$sub_chld_id])) {
                                echo $roll[$sub_chld_id] ? 'check: "checked",' : '';
                            }
                            ?> value: "<?php
                            if (!empty($sub_chld_id)) {
                                echo $sub_chld_id;
                            }
                            ?>",
                        },
                        <?php endforeach; ?>
                    ]
                    },
                    <?php endforeach; ?>
                    <?php else: ?>
                    {
                        id: "", text: "<?php echo $child; ?>", <?php
                        if (!is_array($v_sub_child)) {
                            if (!empty($roll[$v_sub_child])) {
                                echo $roll[$v_sub_child] ? 'check: "checked",' : '';
                            }
                        }
                        ?> value: "<?php
                        if (!empty($v_sub_child)) {
                            echo $v_sub_child;
                        }
                        ?>",
                    },
                    <?php endif; ?>
                    <?php endforeach; ?>
                ]
                },
                <?php endforeach; ?>
                <?php else: ?>
                { <?php if ($parent == 'Dashboard') {
                    ?>
                    id: "", text: "<?php echo $parent ?>", <?php echo 'check: "checked",';
                    ?>  value: "<?php
                    if (!is_array($v_parent)) {
                        echo $v_parent;
                    }
                    ?>"
                    <?php
                    } else {
                    ?>
                    id: "", text: "<?php echo $parent ?>", <?php
                    if (!is_array($v_parent)) {
                        if (!empty($roll[$v_parent])) {
                            echo $roll[$v_parent] ? 'check: "checked",' : '';
                        }
                    }
                    ?> value: "<?php
                    if (!is_array($v_parent)) {
                        echo $v_parent;
                    }
                    ?>"
                    <?php }
                    ?>
                },
                <?php endif; ?>
                <?php endforeach; ?>
            ]
        });
        // show checked node IDs on datasource change
        function onCheck() {
            var checkedNodes = [],
                treeView = $("#treeview").data("kendoTreeView"),
                message;
            checkedNodeIds(treeView.dataSource.view(), checkedNodes);
            $("#result").html(message);
        }
        var menu = $("#treeview").attr("data-menu");
        menu = menu.split(",");

        for(var i = 0;i < menu.length;i++){
            $('input[name="menu[]"]').each(function(){
                if($(this).val()==menu[i]&&$(this).val()!=''){
                    $(this).attr("checked","checked");
                    $(this).parent().parent().parent().parent().parent().find("div:eq(0)").find("input[type='checkbox']").attr("checked","checked");
                }
            });
        }
    })
    
</script>

<script>
    jQuery(document).ready(function($){
        $(".k-icon").each(function(){
            $(this).click(function(){
                if($(this).hasClass("k-plus")){
                    $(this).removeClass("k-plus").addClass("k-minus");
                    $(this).parent().parent().children("ul").show();

                }else if($(this).hasClass("k-minus")){
                    $(this).removeClass("k-minus").addClass("k-plus");
                    $(this).parent().parent().children("ul").hide();
                }
            })
        });
        $(".k-checkbox").each(function(){
            $(this).click(function(){
                if($(this).parent().parent().find("ul").hasClass("k-group")){
                    if($(this).children("input[type='checkbox']").prop("checked")==false){
                        $(this).parent().parent().find("input[type='checkbox']").prop('checked',false);
                    }else{
                        $(this).parent().parent().find("input[type='checkbox']").prop('checked',true);
                    }
                }
            })
        })
    });
</script>
<script>
    jQuery(document).ready(function($){
        $("#treeview .k-checkbox input").eq(0).hide();
        $('form').submit(function () {
            $('#treeview :checkbox').each(function () {
                if (this.indeterminate) {
                    this.checked = true;
                }
            });
        })
    })
</script>
<script>
    jQuery(document).ready(function($){
        var user_flag = document.getElementById("type_user").value;
        if (user_flag == '' || user_flag == 'user')
        {
            $("#roll").show();
        }
        else
        {
            $("#roll").hide();
        }
        // on change user type select action
        $('#type_user').on('change', function() {
            if (this.value == 'user' || this.value == '')
            //.....................^.......
            {
                $("#roll").show();
            }
            else
            {
                $("#roll").hide();
            }
        });
    });
</script>