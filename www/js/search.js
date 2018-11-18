    $(document).ready(function() {
        $('#search_name').bind("change keyup input click", function(event){
            event.preventDefault();
            var search_name=$('#search_name').val(); //Взятие значения тз текстового поля 
            $.ajax({url:"/functions/index.php?search_name="+search_name, cache:false, success:function(result){
            $('.showResult').html(result); //Присвоение HTML-кода в HTML-код элемента
            }});
        });
    });