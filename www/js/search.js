$(document).ready(function() {
    $('#search_name, #search_city, #tag, #fromprice, #toprice, #fromtime, #totime').bind("change input", function(event){
        event.preventDefault();
        var search_name=$('#search_name').val();
        var search_city=$('#search_city').val();
        var search_tag=$('#tag').val();
        var search_fprice=$('#fromprice').val();
        var search_tprice=$('#toprice').val();
        var search_ftime=$('#fromtime').val();
        var search_ttime=$('#totime').val(); //Взятие значения тз текстового поля 
        $.ajax({url:"/functions/index.php?name="+search_name+"&city="+search_city+"&tag="+search_tag +"&fprice="+search_fprice+"&tprice="+search_tprice +"&fdate="+search_ftime+"&tdate="+search_ttime, cache:false, success:function(result){
        $('.showResult').html(result); //Присвоение HTML-кода в HTML-код элемента
        }});
    });
});
