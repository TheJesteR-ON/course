
$(function(){

    function get_dialog_list(){
        $.ajax({url:"../functions/chat.php?dialog-list=get", cache:false, success:function(result){
        $('.dialog-list').html(result); //Присвоение HTML-кода в HTML-код элемента
        }}); 

    }

    //Обновляем чат каждые две секунды
    $(".dialog-list").everyTime(2000, 'refresh', function() {
        get_dialog_list();
    });
});
