$(document).ready(function() {
	console.log('Archivo paisciud.js cargado correctamente.');

	// Inicializar Select2 para País
	$('#usuarios-pais').select2();

	// Hacer la solicitud para obtener la lista de países al cargar la página
	$.ajax({
		url: urlGetPaises,  // Usa la URL que fue definida en la vista PHP
		type: 'GET',
		dataType: 'json',
		success: function(data) {
			console.log("Datos de países obtenidos desde el backend:", data);
			var options = '<option value="">Seleccione un país</option>';

			if (Array.isArray(data)) {
				data.forEach(function(country) {
					options += '<option value="' + country.country + '">' + country.country + '</option>';
				});
			}

			$('#usuarios-pais').html(options); // No es necesario trigger change aquí
		},
		error: function(xhr, status, error) {
			console.error("Error al cargar la lista de países:", error);
			alert('Error al cargar la lista de países');
		}
	});

	// Inicializar Select2 para Ciudad solo una vez al inicio
	$('#usuarios-ciudad').select2();

	// Cargar las ciudades cuando se seleccione un país
	$('#usuarios-pais').change(function() {
		var paisNombre = $(this).val();
		$('#usuarios-ciudad').prop('disabled', true); // Deshabilita el selector mientras carga

		if (paisNombre !== '') {
			$.ajax({
				url: `https://countriesnow.space/api/v0.1/countries/cities`,
				type: 'POST',
				contentType: 'application/json',
				dataType: 'json',
				data: JSON.stringify({ country: paisNombre }),
				success: function(data) {
					var options = '<option value="">Seleccione una ciudad</option>';
					if (data.data && Array.isArray(data.data)) {
						data.data.forEach(function(city) {
							options += `<option value="${city}">${city}</option>`;
						});
					}
					$('#usuarios-ciudad').html(options).prop('disabled', false);
					// No se reinicializa select2, solo se cambia el contenido
				},
				error: function(xhr, status, error) {
					console.error("Error al cargar la lista de ciudades:", error);
					alert('Error al cargar la lista de ciudades');
					$('#usuarios-ciudad').prop('disabled', false);
				}
			});
		} else {
			$('#usuarios-ciudad').html('<option value="">Seleccione una ciudad</option>').prop('disabled', true);
		}
	});
});
