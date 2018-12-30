
        $(function(){

          function get_message_chat(){
            var dialog=$('#n_dialog').val();
            $.ajax({url:"../functions/chat.php?dialog="+dialog, cache:false, success:function(result){
              $('#msg-box').html(result); //Присвоение HTML-кода в HTML-код элемента
              }}); 

          }

          //Обновляем чат каждые две секунды
          $("#t-box").everyTime(2000, 'refresh', function() {
            get_message_chat();
          });
        });
