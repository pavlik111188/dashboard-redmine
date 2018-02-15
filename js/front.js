$(document).ready(function () {

    'use strict';

    // Main Template Color
    var brandPrimary = '#33b35a';

    var idRow = 1;

    // ------------------------------------------------------- //
    // Custom Scrollbar
    // ------------------------------------------------------ //

    if ($(window).outerWidth() > 992) {
         $(window).on("load",function(){
            $("nav.side-navbar").mCustomScrollbar({
                scrollInertia: 200
            });
        });
    }


    // ------------------------------------------------------- //
    // Side Navbar Functionality
    // ------------------------------------------------------ //
    $('#toggle-btn').on('click', function (e) {

        e.preventDefault();

        if ($(window).outerWidth() > 1194) {
            $('nav.side-navbar').toggleClass('shrink');
            $('.page').toggleClass('active');
        } else {
            $('nav.side-navbar').toggleClass('show-sm');
            $('.page').toggleClass('active-sm');
        }
    });

    
    // ------------------------------------------------------- //
    // External links to new window
    // ------------------------------------------------------ //

    $('.external').on('click', function (e) {

        e.preventDefault();
        window.open($(this).attr("href"));
    });


    $('#sendData').submit(function(event) {
        $.ajax({
                url: 'ajax.php', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#sendData").serialize(), // post data || get data
                success : function(result) {
                    // you can see the result from the console
                    // tab of the developer tools
                    if (result.status == 'success') {
                        console.log(result);
                        $('#sendData')[0].reset();
                    }
                },
                error: function(xhr, resp, text) {
                    console.log('err', xhr, resp, text);
                }
            })
      event.preventDefault();
    });
        $('.dynamic-stuff').append('<div class="form-group dynamic-element">'+
                    '<div class="row">'+
                    '<div class="col-md-3">'+
                      '<input type="text" placeholder="Col 1" name="value[]" class="form-control" required="">'+
                    '</div>'+
                    '<div class="col-md-3">'+
                      '<input type="text" placeholder="Col 2" name="value[]" class="form-control" required="">'+
                    '</div>'+
                    '<div class="col-md-3">'+
                      '<input type="text" placeholder="Col 3" name="value[]" class="form-control" required="">'+
                    '</div>'+
                    '<div class="col-md-3">'+
                      '<input type="text" placeholder="Col 4" name="value[]" class="form-control" required="">'+
                    '</div>'+
                      '<div class="col-md-1 delete-area">'+
                        '<button type="button" class="close delete" aria-label="Close">'+
                          '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                      '</div>'+
                    '</div>'+
                  '</div>');
        idRow ++;
        attach_delete();
    // $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();

    // attach_delete();

    //Clone the hidden element and shows it
    $('.add-one').click(function(){
        // $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
        // attach_delete();
        $('.dynamic-stuff').append('<div class="form-group dynamic-element">'+
                    '<div class="row">'+
                    '<div class="col-md-3">'+
                      '<input type="text" placeholder="Col 1" name="value[]" class="form-control" required="">'+
                    '</div>'+
                    '<div class="col-md-3">'+
                      '<input type="text" placeholder="Col 2" name="value[]" class="form-control" required="">'+
                    '</div>'+
                    '<div class="col-md-3">'+
                      '<input type="text" placeholder="Col 3" name="value[]" class="form-control" required="">'+
                    '</div>'+
                    '<div class="col-md-3">'+
                      '<input type="text" placeholder="Col 4" name="value[]" class="form-control" required="">'+
                    '</div>'+
                      '<div class="col-md-1 delete-area">'+
                        '<button type="button" class="close delete" aria-label="Close">'+
                          '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                      '</div>'+
                    '</div>'+
                  '</div>');
        idRow ++;
        attach_delete();
    });


    //Attach functionality to delete buttons
    function attach_delete(){
      $('.delete').off();
      $('.delete').click(function(){
        $(this).closest('.form-group').remove();
      });
    }

    function appendRow(id) {
        
    }

});
