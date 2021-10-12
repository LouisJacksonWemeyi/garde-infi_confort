$(document).ready(function()
{

    $('#form_login').submit(function(ev)
    {
        ev.preventDefault(); // to stop the form from submitting
        //alert($("#form_insert_pro").serialize());
        //return false;
        $.ajax
        (
            {
                method : 'POST',
                //la route (controleur) et le paramètre (id à supprimer)
                url: url + "login",
                dataType: 'text',
                data: {
                    login : $('#email').val(),
                    pass : $('#password').val()
                    //     data_form_login : $("#form_login").serialize()
                },
                success:function(result)
                {
                    if (result == 'OK') {
                        document.location.href=url + "professionnels";
                    } else {
                        $('#result_connexion').html(result);
                    }

                }

            }
        );

    });

});