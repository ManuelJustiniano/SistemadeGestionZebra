 jQuery(document).ready(function(){ 	
    jQuery("#mensaje").hide();
    jQuery("#frmContact").validate({
        rules: {
            vf_nombre: {
                required: true
            },
            vf_apellido: {
                required: true
            },
            vf_pais: {
                required: true
            },
            vf_ciudad: {
                required: true
            },
            vf_email:{
               email: true,
               required: true                    
            },
            vf_telefono: {
                required: true,
                number: true
            },                   
            messages: {
                vf_nombre: "Por favor indica tu nombre.",
                vf_apellido: "Por favor indica su apellido.",
                vf_pais: "Por favor indica el pais.",
                vf_ciudad: "Por favor indica la ciudad.",                        
                vf_telefono: "Por favor, indica tu telefono movil.",                        
                vf_email: {
                        email: "Por favor, indica una direcci&oacute;n de e-mail v&aacute;lida.",
                        required: "Es requerido el email."                    
                    }
            }
        },                
        onkeyup:     false,
        onblur:      false,
        errorElement: "label",
        submitHandler: function(form){
            jQuery("#mensaje").show();
            jQuery("#mensaje").html("<strong>Enviando consulta...</strong>");
            var nombre =  jQuery('#vf_nombre').val(), apellido =  jQuery('#vf_apellido').val(), pais =  jQuery('#vf_pais').val(),  ciudad =  jQuery('#vf_ciudad').val(), correo = jQuery('#vf_email').val(), telefono = jQuery('#vf_telefono').val(), captcha = jQuery('#vf_captcha').val(), mensaje = jQuery('#vf_mensaje').val();

            jQuery.post("send.php",{ vf_nombre: nombre, vf_apellido: apellido, vf_pais: pais, vf_ciudad: ciudad, vf_email: correo, vf_telefono: telefono, vf_captcha: captcha, vf_mensaje: mensaje},
            function(data){
                if(data==1)
                {
                    jQuery("#mensaje").html("<strong>Consulta enviado con satisfaccion. En breve recibir&aacute;s un correo de verificacion. Gracias!</strong>");                             
                    jQuery('#frmContact')[0].reset();
                } else {
                    if(data==2)
                        jQuery("#mensaje").html("<strong>Fallo en el consulta, por favor intente nuevamente, Gracias!</strong>");
                    else
                        jQuery("#mensaje").html("<strong>Fallo en el consulta verifica tus datos,  Gracias!</strong>");
                }
                 
                setTimeout(function() {jQuery('#mensaje').fadeOut('slow');}, 3000);                        
            });
        }
    });

    jQuery("#mensaje2").hide();
    jQuery("#frmContact1").validate({
        rules: {
            vf_nombre: {
                required: true
            },                    
            vf_correo:{
               email: true,
               required: true                    
            },
            vf_telefono: {
                required: true,
                number: true
            },                   
            messages: {
                vf_nombre: "Por favor indica tu nombre.",                      
                vf_telefono: "Por favor, indica tu telefono movil.",                        
                vf_correo: {
                        email: "Por favor, indica una direcci&oacute;n de e-mail v&aacute;lida.",
                        required: "Es requerido el email."                    
                    }
            }
        },                
        onkeyup:     false,
        onblur:      false,
        errorElement: "label",
        submitHandler: function(form){
            jQuery("#mensaje2").show();
            jQuery("#mensaje2").html("<strong>Enviando consulta...</strong>");
            var nombre =  jQuery('#vf_nombre').val(), correo = jQuery('#vf_correo').val(), telefono = jQuery('#vf_telefono').val(), captcha = jQuery('#vf_captcha').val(), mensaje = jQuery('#vf_mensaje').val();

            jQuery.post("send2.php",{ vf_nombre: nombre, vf_correo: correo, vf_telefono: telefono, vf_mensaje: mensaje, vf_captcha: captcha},
            function(data){
                if(data==1)
                {
                    jQuery("#mensaje2").html("<strong>Consulta enviado con satisfaccion. En breve recibir&aacute;s un correo de verificacion. Gracias!</strong>");                             
                    jQuery('#frmContact')[0].reset();
                } else {
                    if(data==2)
                        jQuery("#mensaje2").html("<strong>Fallo en el consulta, por favor intente nuevamente, Gracias!</strong>");
                    else
                        jQuery("#mensaje2").html("<strong>Fallo en el consulta verifica tus datos,  Gracias!</strong>");
                }
                 
                setTimeout(function() {jQuery('#mensaje2').fadeOut('slow');}, 3000);                        
            });
        }
    });
});