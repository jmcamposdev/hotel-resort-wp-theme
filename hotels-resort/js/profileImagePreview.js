function init() {
  console.log('profileImagePreview.js');
  let inputFile = document.getElementById('user_pic');

  inputFile.addEventListener('change', function(e) {
    let file = e.target.files[0];
    let reader = new FileReader();

    reader.onload = function(e) {
      let img = document.getElementById('user_pic_preview');
      img.src = e.target.result;
    }

    reader.readAsDataURL(file);
  });
}

window.addEventListener('load', init);