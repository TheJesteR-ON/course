    function handleFileSelectMulti(evt) {
        var files = evt.target.files; // FileList object
        document.getElementById('outputMulti').innerHTML = "";
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                alert("Только изображения....");
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img class="img-thumbnail" src="', e.target.result,
                                    '" title="', escape(theFile.name), '"/>'].join('');
                document.getElementById('outputMulti').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('fileMulti').addEventListener('change', handleFileSelectMulti, false);

    function showSubtype(t_id){
        
        $.ajax({url:"/functions/createAd.php?type_id="+t_id, 
        cache:false, 
        dataType: "html",
        success:function(result){
            $('#subtype_list').html(result); //Присвоение HTML-кода в HTML-код элемента
        }
        });
        
    };
    
