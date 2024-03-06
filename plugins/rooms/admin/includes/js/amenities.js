jQuery(document).ready(function($) {
  // When to enable or disable remove button depending on row count
  function updateRemoveButton() {
    // Get the row count
    let rowCount = $('#custom-array-tbody tr').length;

    $('#remove-row').prop('disabled', rowCount <= 1);

  }

  // Add new row 
  $('#add-row').on('click', function(e) {
    let lastRow = $('#custom-array-tbody tr:last'); // Get the last row
    let lastRowInputs = lastRow.find('input'); // Get the inputs of the last row
    let filledInputs = lastRowInputs.filter(function() { // Filter the inputs that have value
      return $(this).val() != '';
    }).length;
    let hasValue = filledInputs > 0
    // Add a new row only if the last row has value
    if (hasValue) {
      let rowCount = $('#custom-array-tbody tr').length; // Get the row count
      let newRow = `<tr>
      <td><input type="text" class="td-name" name="jmc_custom_array_field[${rowCount}][key1]" value="" id=""></td>
      <td><button type="button" id="remove-row" class="td-delete button button-primary"><span class="dashicons dashicons-dismiss"></span>&nbsp;Remove</button></td>
    </tr>`; // Create a new row
      $('#custom-array-tbody').append(newRow); // Append the new row
      updateRemoveButton(); // Update the remove button
    }
  });

  // Remove row
  $('.custom-array-metabox').on('click', '#remove-row' ,function(e) {
    $(this).closest('tr').remove(); // Remove the row
    updateRemoveButton(); // Update the remove button
  });

  // Initialization
  updateRemoveButton();

  // // Si el usuario agreaga una foto del slider añadir la previsualización
  // $('#jmc_new_slider_images').on('change', function() {
  //   var input = this;
  //   if (input.files && input.files[0]) {
  //     var reader = new FileReader();
  //     reader.onload = function(e) {
  //       var thumbnail = $('<img>').attr('src', e.target.result);
  //       console.log(thumbnail);
  //       var removeButton = $('<button>').attr({
  //         type: 'button',
  //         class: 'remove-image button button-primary',
  //         title: 'Remove image'
  //       }).html('<span class="dashicons dashicons-dismiss"></span>&nbsp;Remove');
  //       var sliderImage = $('<div>').attr('class', 'slider-image').append(thumbnail, removeButton);
  //       $('.slider-images').append(sliderImage);
  //       slidersModified = true;
  //     }
  //     reader.readAsDataURL(input.files[0]);
  //   }
  // });

// Variable de control para verificar si se ha modificado algo en los sliders
let slidersModified = false;

// // Script para eliminar una imagen y marcarla para eliminación
// $('.slider-images').on('click', '.remove-image', function() {
//     var imageSrc = $(this).prev('.thumbnail').attr('src');
//     $(this).closest('.slider-image').remove();
//     $('<input>').attr({
//         type: 'hidden',
//         name: 'jmc_removed_slider_images[]',
//         value: imageSrc
//     }).appendTo('.slider-images');

//     // Se ha modificado algo en los sliders
//     slidersModified = true;
// });

// // Verificar si el formulario de actualización ha sido enviado
// const updateForm = document.getElementById('wp-link');
// if (updateForm) {
//     updateForm.addEventListener('submit', function () {
//         // Recargar la página solo si se han modificado los sliders
//         if (slidersModified) {
//             location.reload();
//         }
//     });
// }

// Obtener el ID del post actual en la página de edición de un post en WordPress
var postId = $('#post_ID').val();

// Cargar imagen del slider
$('#jmc_new_slider_images').on('change', function() {
  var file_data = $(this).prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);
  form_data.append('action', 'upload_slider_image');
  form_data.append('post_id', postId); // Reemplaza YOUR_POST_ID con el ID del post actual

  $.ajax({
      url: ajaxurl,
      type: 'POST',
      contentType: false,
      processData: false,
      data: form_data,
      success: function(response) {
          // Manejar la respuesta del servidor (URL de la imagen cargada)
          var thumbnail = $('<img>').attr('src', response).attr('class', 'thumbnail');
          var removeSpan = $('<span>').attr({
              class: 'dashicons dashicons-dismiss remove-image',
          })
          var sliderImage = $('<div>').attr('class', 'slider-image').append(thumbnail, removeSpan);
          $('.slider-images').append(sliderImage);

          // Add the delete event 
          // Aquí puedes mostrar la imagen cargada en la vista previa del slider
      },
      error: function(xhr, status, error) {
          // Manejar errores si es necesario
          console.error(xhr.responseText);
      }
  });
});

// Eliminar imagen del slider (Delegación de eventos)
$('.slider-images').on('click', '.remove-image', function() {
  var image_url = $(this).prev('.thumbnail').attr('src');
  console.log(image_url);
  var data = {
      action: 'delete_slider_image',
      post_id: postId, // Reemplaza YOUR_POST_ID con el ID del post actual
      image_url: image_url
  };

  var removeButton = $(this);

  $.post(ajaxurl, data, function(response) {
      // Manejar la respuesta del servidor (confirmación de eliminación)
      removeButton.closest('.slider-image').remove();
      // Aquí puedes eliminar la imagen de la vista previa del slider
  });
});

});