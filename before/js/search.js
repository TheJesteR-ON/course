$(document).ready(function() {
    $('#search_name, #subtype_list, #sorting-list, #search_city, #tag, #fromprice, #toprice, #fromtime, #totime').bind("change input", function(event){
        event.preventDefault();
        var search_name=$('#search_name').val();
        var search_city=$('#search_city').val();
        var search_tag=$('#tag').val();
        var search_subtag=$('#subtype_list').val();
        var kind_sort=$('#sorting-list').val();
        var search_fprice=$('#fromprice').val();
        var search_tprice=$('#toprice').val();
        var search_ftime=$('#fromtime').val();
        var search_ttime=$('#totime').val(); //Взятие значения тз текстового поля 
        $.ajax({url:"/functions/index.php?kind_sort="+kind_sort+"&name="+search_name+"&city="+search_city+"&tag="+search_tag +"&subtag="+search_subtag +"&fprice="+search_fprice+"&tprice="+search_tprice +"&fdate="+search_ftime+"&tdate="+search_ttime, cache:false, 
        success:function(result){
            $('.showResult').html(result); //Присвоение HTML-кода в HTML-код элемента
            
            $('#count-ad').html($('#block-count').html());
        }});
    });

    $('#b_advsearch').bind("click", function(event){
        event.preventDefault();
        var search_name=$('#search_name').val();
        var search_city=$('#search_city').val();
        var search_tag=$('#tag').val();
        var search_subtag=$('#subtype_list').val();
        var kind_sort=$('#sorting-list').val();
        var search_fprice=$('#fromprice').val();
        var search_tprice=$('#toprice').val();
        var search_ftime=$('#fromtime').val();
        var search_ttime=$('#totime').val(); //Взятие значения тз текстового поля 
        $.ajax({url:"/functions/index.php?kind_sort="+kind_sort+"&name="+search_name+"&city="+search_city+"&tag="+search_tag +"&subtag="+search_subtag +"&fprice="+search_fprice+"&tprice="+search_tprice +"&fdate="+search_ftime+"&tdate="+search_ttime, cache:false, success:function(result){
            $('.showResult').html(result); //Присвоение HTML-кода в HTML-код элемента

            $('#count-ad').html($('#block-count').html());
        }});
    });

    
});
