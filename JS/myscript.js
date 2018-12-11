/**
 * Created by Grégory on 20-09-18.
 */

$(document).ready(function(){
    $("#cssmenu ul li a").click(function(){
        $(this).removeClass("active");
        //$(this).addClass("active");
        var id= $(this).attr("id");
        //alert(id);
        $(this).addClass("active");
    });

    $("#acceuil").click(function () {
       $(this).css('color','red');
    });
});
