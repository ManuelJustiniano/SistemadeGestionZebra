function action(url)
{
	$.get(url, function(data) {
		$.pjax.reload({container:"#table"});
	});
}

function cambiarEstadoProyecto(url) {
	if (confirm('¿Está seguro de que desea cambiar el estado del proyecto?')) {
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			success: function(response) {
				if (response.exito) {
					alert(response.mensaje);
					location.reload();
				} else {
					alert('Error: ' + response.mensaje);
				}
			},
			error: function() {
				alert('Hubo un problema al cambiar el estado del proyecto.');
			}
		});
	} else {
		console.log('Cambio de estado cancelado por el usuario.');
	}
}




function cambiarEstadoTarea(url) {
	if (confirm('¿Está seguro de que desea cambiar el estado de la tarea?')) {
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			success: function(response) {
				if (response.exito) {
					alert(response.mensaje);
					location.reload();
				} else {
					alert('Error: ' + response.mensaje);
				}
			},
			error: function() {
				alert('Hubo un problema al cambiar el estado de la tarea.');
			}
		});
	} else {
		console.log('Cambio de estado cancelado por el usuario.');
	}
}




function cambiarEstadoUsuario(url) {
	if (confirm('¿Está seguro de que desea cambiar el estado del usuario?')) {
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			success: function(response) {
				if (response.exito) {
					alert(response.mensaje);
					location.reload();
				} else {
					alert('Error: ' + response.mensaje);
				}
			},
			error: function() {
				alert('Hubo un problema al cambiar el estado del usuario.');
			}
		});
	} else {
		console.log('Cambio de estado cancelado por el usuario.');
	}
}