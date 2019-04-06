<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    var table,thead,tbody,by,action,time,content;
    var historyModal = $("#historyModal");
    $("body").on("click",".openhistory",function(){
        $.ajax({
            url:"{{config('app.url')}}/history",
            type:"get",
            data:{a:$(this).attr('a'),b:$(this).attr('b')},
            success:function(data){
                try{
                    data = JSON.parse(data);
                    historyModal.find(".modal-body").html("");
                    by = "<th>By</th>";
                    action = "<th>Action</th>";
                    time = "<th>Time</th>";

                    table = $("<table class='table table-striped table-bordered'></table>");
                    thead = $("<thead><tr>"+by+action+time+"</tr></thead>");
                    tbody = $("<tbody></tbody>");
                    historyModal.find(".modal-body").append(table);
                    table.append(thead);
                    table.append(tbody);
                    console.log(data);
                    data.forEach(function(item,i){
                        content = "<tr>";
                        content += "<td>";
                        content += item.by;
                        content += "</td>";
                        content += "<td>";
                        content += item.status;
                        content += "</td>";
                        content += "<td>";
                        content += item.time;
                        content += "</td>";
                        content += "</tr>";
                        tbody.append(content);
                    })

                }catch(err){
                    console.log(err);
                }
            }
        })
        .fail(function(){
            
        })
        .done(function(){

        })
    })
</script>