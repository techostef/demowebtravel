<!DOCTYPE html>
<html>
<head>

<style>
body{
  -webkit-print-color-adjust:exact;
  color-adjust:exact;
}
*{
    font-size:12px;
    -webkit-print-color-adjust:exact;
    color-adjust:exact;
}
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr{
    background-color: #d1b6da !important;
}

tr:nth-child(even){
    background-color: #f2f2f2 !important;
}

th {
    background-color: #373a37 !important;
    color: white !important;
}
.button{
    margin:5px;
    padding:5px;
    border-radius: 5px;
    cursor:pointer;
}
@media print{
    table {
        border-collapse: collapse;
        width: 100% !important;
    }
    @page {
        size: landscape;
        margin: 1mm 1mm 1mm 1mm;  
    }
    th, td {
        text-align: left;
        padding: 8px;
    }
    tr{
        background-color: #d1b6da !important;
    }

    tr:nth-child(even){
        background-color: #f2f2f2 !important;
    }

    th {
        background-color: #373a37 !important;
        color: white !important;
    }
    #control{
        display:none !important;
    } 
}
</style>
<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

<script src="{{asset('js/vendor/jquery-2.1.4.min.js')}}"></script>

</head>
<!--<body onload="window.print()">-->
<body>

<div id='control'>
    <button class="button print">Print</button>
</div>

<table id="bootstrap-data-table" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>No Unik</th>
        <th>Nama</th>
        <th>No KTP</th>
        <th>Alamat</th>
        <th>Pekerjaan</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
    </tr>
    </thead>
    <tbody>
        <?php $no=1;?>
        @foreach($result as $val)
            <tr>
                <td>{{$no}}</td>
                <td>{{$val['no_unik']}}</td>
                <td>{{$val['nama_nasabah']}}</td>
                <td>{{$val['no_ktp']}}</td>
                <td>{{$val['alamat_nasabah']}}</td>
                <td>{{$val['pekerjaan_nasabah']}}</td>
                <td>{{$val['jenis_kelamin']}}</td>
                <td>{{$val['tanggal_lahir']}}</td>
            </tr>
            <?php $no++;?>
        @endforeach
    </tbody>
</table>
<script>
    var table = $("#bootstrap-data-table");
    var content,temp,index,sort,max,i,j,select;
    $(".print").click(function(){
        window.print();
    })

    table.find("thead").eq(0).find("tr").eq(0).find("th").each(function(){
        temp = $(this).html();
        content = "<span style='margin-left:5px;' class='iconfilter fa fa-arrows-v'></span>";
        $(this).html(temp+content);
        $(this).css("cursor","pointer");

        $(this).click(function(){
            index = table.find("thead").eq(0).find("tr").eq(0).find("th").index($(this));
            table.find("thead").eq(0).find("tr").eq(0).find("th").each(function(){
                $(this).find(".iconfilter").remove();
                content = "<span style='margin-left:5px;' class='iconfilter fa fa-arrows-v'></span>";
                temp = $(this).html();
                $(this).html(temp+content);
            })
            $(this).find(".iconfilter").remove();
            temp = $(this).html();
            if($(this).attr("data-sorting")==undefined){
                // for sorting desc or asc
                sort = "desc"; 
                content = "<span style='margin-left:5px;' class='iconfilter fa fa-arrow-down'></span>";
                $(this).html(temp+content);
                $(this).attr("data-sorting",sort);
                
            }else{
                if($(this).attr("data-sorting")=="desc"){
                    // for sorting desc or asc
                    sort = "asc"; // change sorting from desc to asc
                    // icon desc
                    content = "<span style='margin-left:5px;' class='iconfilter fa fa-arrow-up'></span>";
                    $(this).html(temp+content);
                    $(this).attr("data-sorting",sort);
                }else if($(this).attr("data-sorting")=="asc"){
                    // for sorting desc or asc
                    sort = "desc"; 
                    // icon asc
                    content = "<span style='margin-left:5px;' class='iconfilter fa fa-arrow-down'></span>";
                    $(this).html(temp+content);
                    $(this).attr("data-sorting",sort);
                }
            }
            max = table.find("tbody").eq(0).find("tr").length;
            
            
            if(sort=="desc"){
                for(i=0;i<max;i++){
                    for(j=0;j<max;j++){
                        select = table.find("tbody").eq(0).find("tr");
                        if(select.eq(j).find("td").eq(index).text().toLowerCase()>select.eq(j+1).find("td").eq(index).text().toLowerCase()){
                            select.eq(j).insertAfter(select.eq(j+1));
                        }
                    }
                }
                
            }else{
                for(i=0;i<max;i++){
                    for(j=0;j<max-i;j++){
                        select = table.find("tbody").eq(0).find("tr");
                        if(select.eq(j).find("td").eq(index).text().toLowerCase()<select.eq(j+1).find("td").eq(index).text().toLowerCase()){
                            select.eq(j).insertAfter(select.eq(j+1));
                        }
                    }
                }

            }

            
        })
    })
</script>

</body>
</html>
