<div class="modal" style="top:50px;" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">History</h5>
                <a class="closeModal" data-dismiss="modal" style="font-size:20px;cursor:pointer" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                    
                <button type="button" class="btn btn-primary" id='submitModal'>Save</button>
                <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" style="top:50px;" id="loadModalView" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">History</h5>
                    <a class="closeModalView" data-dismiss="modal" style="font-size:20px;cursor:pointer" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeModalView" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<script>
    
    var loadview = $('.loadview');
    var closeModal = $('.closeModal');
    var loadModal = $('#loadModal');
    var openmodal = $('.openmodal');
    var url,target,type;
    $("body").on("click",".openmodal",function(){
        target = $($(this).attr("data-target"));
        target.show().removeClass("fade");
        target.find("button").click(function(){
            target.hide();
        })
    });
    $(".closeModalView").click(function(){
        $("#loadModalView").hide();
    })
    $(".closeModal").click(function(){
        $("#loadModal").hide();
    })
    $("body").on("click",".loadview",function(){
        type = $(this).attr("data-type");
        if(type=="view"){
            
            $("#loadModalView").show();
        }else{
            $("#loadModal").show();
        }
        url = $(this).attr('data-href');
        loadModal.find(".modal-title").text($(this).attr("data-title"));
        $.ajax({
            url: url, // form action url
            cache: false,
            dataType: "html",
            beforeSend:function(){
                addLoading();
            },
            afterSend: function() {
                removeLoading();
            },
            success: function(data){
                try{
                    if(type=="view"){
                        $("#loadModalView").find(".modal-body").html(data).fadeIn();
                    }else{
                        loadModal.find(".modal-body").html(data).fadeIn();
                        $("#submitModal").click(function(){
                            submitform();
                        });
                    }
                    
                }catch(err){
                    console.log(err);
                }
            },
            error: function(e) {
                console.log(e);
            }
        })
        .fail(function(){
            removeLoading();
            errormsg("Gagal terkoneksi ke server");
        })
        .done(function(){
            removeLoading();
        })
    })
</script>