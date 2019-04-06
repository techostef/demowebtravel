<script>
    
    jQuery(document).ready(function($){
        function readURL(input,target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(target).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        var a = $("#selectLg");
        a.val(a.attr('data-set'));

        
        // change foto
        $("#foto").change(function(){
            var fileInput = $(this);

            var filePath = fileInput.val();
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if(allowedExtensions.exec(filePath)){
                if(this.files[0].size>8000000){
                    alert("File terlalu besar..");
                    fileInput.val('');
                    return false;

                }else{
                    readURL(this,"#containerfoto");
                }

            }else{
                alert("File harus gambar");
                fileInput.val('');
                return false;
            }

        });
        $("#formuser").submit(function(e){
            if($("#password1").length>0){
                if($("#password1").val()!==$("#password2").val()){
                    alert('Password tidak sama');
                    e.preventDefault(e);
                }
            }
        });
        $("#password2").keyup(function(){
            if($(this).length==0){
                $("#verPassword").text('Verifikasi password agar password sama');
                $(this).removeClass('is-valid');
                $(this).removeClass('is-invalid');
            }else{
                if($("#password1").val()===$("#password2").val()){
                    $("#verPassword").text('Password sama');
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }else{
                    $("#verPassword").text('Password tidak sama');
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                }
            }
        });
        $("#password1").keyup(function(){
            if($("#password1").val()===$("#password2").val()){
                    $("#verPassword").text('Password sama');
                    $("#password2").removeClass('is-invalid');
                    $("#password2").addClass('is-valid');
                }else{
                    $("#verPassword").text('Password tidak sama');
                    $("#password2").removeClass('is-valid');
                    $("#password2").addClass('is-invalid');
                }
        });
    })
</script>