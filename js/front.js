$(document).ready(function () {

    'use strict';

    $('#sendData').submit(function(event) {
        $.ajax({
                url: 'ajax.php', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#sendData").serialize(), // post data || get data
                success : function(result) {
                    // you can see the result from the console
                    // tab of the developer tools
                    console.log(result);
                },
                error: function(xhr, resp, text) {
                    console.log(xhr, resp, text);
                }
            })
      event.preventDefault();
    });

    $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();

    //Clone the hidden element and shows it
    $('.add-one').click(function(){
      $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
      attach_delete();
    });


    //Attach functionality to delete buttons
    function attach_delete(){
      $('.delete').off();
      $('.delete').click(function(){
        console.log("click");
        $(this).closest('.form-group').remove();
      });
    }

});
