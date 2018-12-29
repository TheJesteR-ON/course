
        $(function(){

          function get_message_chat(){
            /* //Генерируем Ajax запрос
            $.ajaxSetup({url: "../functions/chat.php",global: true,type: "GET",data: "event=get"});
            $.ajax({
              success: function(msg_j){
                  //Парсим JSON
                  var obj = JSON.parse(msg_j);
                  //Проганяем циклом по всем принятым сообщениям

                  for(var i=0; i < obj.length; i ++){
                    //Добавляем в чат сообщение
                    $("#msg-box ul").append("<li><b>"+obj[i].name+"</b>: "+obj[i].msg+"</li>");
                  }
                  //Прокручиваем чат до самого конца
                  $("#msg-box").scrollTop(2000);
              }
            }); */
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
