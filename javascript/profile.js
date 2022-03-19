// $(document).ready(function(){
//     // Prepare the preview for profile picture
//         $("#wizard-picture").change(function(){
//             readURL(this);
//         });
//     });
//     function readURL(input) {
//         if (input.files && input.files[0]) {
//             var reader = new FileReader();
    
//             reader.onload = function (e) {
//                 $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
//             }
//             reader.readAsDataURL(input.files[0]);
//         }
//     }
function triggerClick(e) {
    document.querySelector('#profileImage').click();
  }
  function displayImage(e) {
    if (e.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }
    