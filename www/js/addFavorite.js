function addFavorite(ad_id){

    $.ajax({
        url: "../functions/index.php",
        type: "POST",
        async: false, 
        data: { ad_favorite: ad_id},
        dataType: "html",

        success: function(data) {
            if(data.indexOf("add") != -1)
                document.getElementById("i-"+ad_id).style.backgroundColor = "#2fbdb4";
            else
                document.getElementById("i-"+ad_id).style.backgroundColor = "lightgrey";
        },

        error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log('STATUS: '+textStatus+'\nERROR THROWN: '+errorThrown+'\n'+XMLHttpRequest);
            $('.showResult').html("<div>ERROR/ это просто ******</div>");
        }
    });
};

