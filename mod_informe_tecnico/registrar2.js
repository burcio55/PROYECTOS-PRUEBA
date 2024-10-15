function accion_editar_registro(id_reporte, data) {
    // Populate the edit form with data from the record
    for (const field in data) {
      if (document.getElementById(field)) 
        {
        document.getElementById(field).value = data[field];
      }
    }
    // Hide the "Add" button and show the "Update" button
    $('#agregar').css('display', 'none');
    $('#actualizar').css('display', 'block');
  }
  

function accion_reporte_modificar(id_reporte) {
    // Retrieve form data
    const formData = new FormData(document.getElementById('reportForm'));
  
    // Validate required fields
    let hasErrors = false;
    const requiredFields = ['nacionalidad', 'cedula', 'nnumero_requer_glpi', 'ubicacion_administrativa_scodigo', 'nbien_publico', 'snombre_dispositivo', 'dispositivos_id', 'estatus_id', 'marca_id', 'smodelo', 'sserial', 'sdisco_duro', 'smemoria_ram', 'sobservaciones_tecnico', 'srecomendaciones_tecnico', 'final_id', 'motivo_desincorporacion'];
  
    for (const field of requiredFields) {
      if (formData.get(field).trim() === '') {
        document.getElementById(field).style.borderColor = 'red';
        hasErrors = true;
      } else {
        document.getElementById(field).style.borderColor = '#999999';
      }
    }
  
    if (hasErrors) {
      alert('Debe llenar los datos obligatorios');
      return;
    }
  
    // Send Ajax request to update the report
    $.ajax({
      url: 'interaccion2.php?id_reporte=' + id_reporte,
      type: 'POST',
      data: formData,
      success: function(response) {
        // Handle response from server
        const [status, message, updatedData] = response.split(' / ');
  
        if (status === '0') {
          alert('ERROR: ' + message);
        } else {
          alert(message);
          if (updatedData) {
            // Update the DOM with updated data
            updateDOMWithReportData(updatedData);
          }
        }
      },
      error: function(error) {
        console.error('Error updating report:', error);
        alert('Error al actualizar el reporte');
      }
    });
  }
  
  function updateDOMWithReportData(data) {
    // Update the report details in the DOM using data
    // ...
  }