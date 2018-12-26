
        $(function(){

          //Переменная отвечает за id последнего пришедшего сообщения
          var mid = 0;
          //Функция обновления сообщений чата
          function get_message_chat(){
            //Генерируем Ajax запрос
            $.ajaxSetup({url: "chat.php",global: true,type: "GET",data: "event=get&id="+mid+"&t="+
                (new Date).getTime()});
            //Отправляем запрос
            $.ajax({
              //Если все удачно
              success: function(msg_j){
                //Если есть сообщения в принятых данных
                if(msg_j.length > 2){
                  //Парсим JSON
                  var obj = JSON.parse(msg_j);
                  //Проганяем циклом по всем принятым сообщениям
                  for(var i=0; i < obj.length; i ++){
                    //Присваиваем переменной ID сообщения
                    mid = obj[i].id;
                    //Добавляем в чат сообщение
                    $("#msg-box ul").append("<li><b>"+obj[i].name+"</b>: "+obj[i].msg+"</li>");
                  }
                  //Прокручиваем чат до самого конца
                  $("#msg-box").scrollTop(2000);
                }
              }
            });
          }
         
          //Первый запрос к серверу. Принимаем сообщения
          get_message_chat();
         
          //Обновляем чат каждые две секунды
          $("#t-box").everyTime(2000, 'refresh', function() {
            get_message_chat();
          });
         
          //Событие отправки формы
          $("#t-box").submit(function() {
            //Запрашиваем имя у юзера.
            
              //Тащим сообщение из формы
              var msg = $("#t-box input[class='msg']").val();
              //Если сообщение не пустое
              if(msg != ""){
                //Чистим форму
                $("#t-box input[class='msg']").attr("value", "");
                //Генерируем Ajax запрос
                $.ajaxSetup({url: "chat.php", type: "GET",data: "event=set&name="+
                    $("#t-box input[class='name']").val()+"&msg="+msg});
                //Отправляем запрос
                $.ajax();
              }
            //Возвращаем false, чтобы форма не отправлялась.
            return false;
          });
        });
