<script>
    
    function checkForm(form){
        var result = 0;
        $('#'+form).find("[name!='']").each(function(){
            var attr = $(this).attr('name');
            var val = $(this).val();
            
            if (typeof attr !== typeof undefined && attr !== false) {
            if($(this).prop('required')){
                if($(this).val()==""){ // check salah satu input yang berada di form jika tidak disi ketika required
                    $(this).css({"border":"1px solid red"});
                    result=1;
                }else{
                    $(this).css({"border":"1px solid #dcdcdc"});
                }
            }
            }
        })
        return result;
    }
    var base_url = "{{config('app.url')}}";
    var height = $(window).height();
    var f_h = height / 5;
    var loading =
        '<div style="height:' +
        height +
        'px; width:100%;">' +
        '<div class="spinner" style="top:' +
        f_h +
        'px;position:relative;">' +
        '<div class="rect1"></div>' +
        '  <div class="rect2"></div>' +
        '  <div class="rect3"></div>' +
        '  <div class="rect4"></div>' +
        '  <div class="rect5"></div>' +
        "</div>";
        +"</div>";
    function modal_form(title, noty, form_id) {
        bootbox.dialog({
            title: title,
            message: "<div id='form'></div>",
            buttons: {
            success: {
                label: "Submit",
                className: "btn-purple enterer",
                callback: function() {
                if (noty == "button") {
                    return false;
                } else {
                    if (form_submit(form_id, noty) !== false) {
                    return false;
                    } else {
                    return false;
                    }
                }
                }
            },
            danger: {
                label: "Cancel",
                className: "btn-dark",
                callback: function() {
                    errormsg("Cancel");
                    $("#ui-datepicker-div").remove();
                }
            }
            }
        });
    }
    function ajax_modal(type, title, noty, form_id, id,href) {
        modal_form(title, noty, form_id);
        ajax_load(
            href,
            "form",
            "form"
        );
    }
    function ajax_load(url, id, type) {
        var list = $("#" + id);
        $.ajax({
            url: url, // form action url
            cache: false,
            dataType: "html",
            beforeSend: function() {
            //list.fadeOut();
            if (type !== "other") {
                list.html(loading); // change submit button text
            }
            },
            afterSend: function() {
            //list.fadeOut();
            if (type !== "other") {
                list.html(loading); // change submit button text
            }
            },
            success: function(data) {
            if (data !== "") {
                list.html("");
                list.html(data).fadeIn(); // fade in response data
            }
            if (type == "first") {
                $("#demo-table").bootstrapTable();
                set_switchery();
                $("#demo-table img").each(function() {
                if ($(this).attr("src") !== "") {
                    if ($(this).data("im") !== "fb") {
                    $(this).attr(
                        "src",
                        $(this).attr("src") + "?random=" + new Date().getTime()
                    );
                    }
                }
                });
            } else if (type == "form") {
                //reloadStylesheets();
                // $("#demo-tp-textinput").timepicker({
                //     minuteStep: 5,
                //     showInputs: false,
                //     disableFocus: true
                // });
            } else if (type == "delete") {
                ajax_load(
                base_url + "" + user_type + "/" + module + "/" + list_cont_func,
                "list",
                "first"
                );
                other_delete();
            } else if (type == "hidden") {
                list.hide();
            } else if (type == "other") {
                other();
            } else {
            }
            },
            error: function(e) {
            console.log(e);
            }
        });
    }
</script>