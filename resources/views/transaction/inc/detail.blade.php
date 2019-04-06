<div class="row form-group">
    <div class="col col-md-12">
        <button type="button" id="additem" class="btn btn-primary pull-right"><span class="fa fa-plus"></span></button>
        <table class="table table-striped table-bordered dataTable no-footer">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="detilitem">
                @if(empty($detail))
                    <tr id="msgitem">
                        <td colspan="5">Empty</td>
                    </tr>
                @else
                    @foreach($detail as $row)
                        <tr>
                            <td>
                            <input class='itemid' name='itemid[]' value='{{$row['id']}}' style="display:none">
                            <input name='itemname[]' value='{{$row['item']}}' class='itemname form-control'></td>
                            <td><input name='itemqty[]' value='{{$row['qty']}}' class='itemqty form-control'></td>
                            <td><input name='itemprice[]' value='{{$row['price']}}' class='itemprice form-control'></td>
                            <td><input name='itemsubtotal[]' value='{{round($row['subtotal'],2)}}' class='itemsubtotal form-control'></td>
                            <td><button class='btn btn-danger rmitem' type='button'><span class='fa fa-trash'></span></button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    
</div>
<script>
    var total_item = $("#total_item");
    var total_price = $("#total_price");
    var detilitem = $("#detilitem");
    var additem = $("#additem");
    var index,qty,prices,subtotal,total;
    var msgitem = '<tr id="msgitem">'+
    '<td colspan="5">Empty</td>'+
    '</tr>';
    var template = "<tr>"+
    "<td>"+"<input name='itemname[]' class='itemname form-control'>"+"</td>"+
    "<td>"+"<input name='itemqty[]' class='itemqty form-control'>"+"</td>"+
    "<td>"+"<input name='itemprice[]' class='itemprice form-control'>"+"</td>"+
    "<td>"+"<input name='itemsubtotal[]' class='itemsubtotal form-control'>"+"</td>"+
    "<td>"+"<button class='btn btn-danger rmitem' type='button'><span class='fa fa-trash'></span></button>"+"</td>"+
    "</tr>";
    additem.click(function(){
        if($("#msgitem").length>0){
            $("#msgitem").remove();
        }
        detilitem.append(template);
    })
    $("body").on("click",".rmitem",function(){
        console.log($(this).parent().parent().find(".itemid").length);
        if($(this).parent().parent().find(".itemid").length>0){
            $(this).parent().parent().find(".itemid").attr("name","itemiddelete[]");
            $(this).parent().parent().parent().parent().parent().append($(this).parent().parent().find(".itemid").eq(0));
        }
        $(this).parent().parent().remove();
        if(detilitem.find("tr").length==0){
            detilitem.append(msgitem);
        }
        total = 0;
        $(".itemsubtotal").each(function(){
            total +=  parseFloat($(this).val()!=""?$(this).val():0);
        })
        total_price.val(number_format(total,2,",","."));
    })

    $("body").on("change",".itemqty",function(){
        index = $(".itemqty").index($(this));
        qty = $(".itemqty").eq(index).val()==""?0:$(".itemqty").eq(index).val();
        price = $(".itemprice").eq(index).val()==""?0:$(".itemprice").eq(index).val();
        subtotal = parseInt(qty)*parseFloat(price);
        $(".itemsubtotal").eq(index).val(subtotal);

        total = 0;
        $(".itemqty").each(function(){
            total = total + parseInt($(this).val()?$(this).val():0);
        })
        total_item.val(total);

        total = 0;
        $(".itemsubtotal").each(function(){
            total +=  parseFloat($(this).val()!=""?$(this).val():0);
        })
        total_price.val(number_format(total,2,",","."));
    })

    $("body").on("change",".itemprice",function(){
        index = $(".itemprice").index($(this));
        qty = $(".itemqty").eq(index).val()==""?0:$(".itemqty").eq(index).val();
        price = $(".itemprice").eq(index).val()==""?0:$(".itemprice").eq(index).val();
        subtotal = parseInt(qty)*parseFloat(price);
        $(".itemsubtotal").eq(index).val(subtotal);
        total = 0;
        $(".itemsubtotal").each(function(){
            total +=  parseFloat($(this).val()!=""?$(this).val():0);
        })
        total_price.val(number_format(total,2,",","."));
    })
    function number_format (number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>