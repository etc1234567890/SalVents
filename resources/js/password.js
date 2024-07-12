document.addEventListener('DOMContentLoaded', () => {
  const passwordb = document.getElementById('password-button');
  const openpass = document.getElementById('eye-icon-open');
  const closepass = document.getElementById('eye-icon-close');
  const passfield = document.getElementById('password');

  const conpasswordb = document.getElementById('password_confirmation-button');
  const conopenpass = document.getElementById('eye-icon-confirm-open');
  const conclosepass = document.getElementById('eye-icon-confirm-close');
  const conpassfield = document.getElementById('password_confirmation');

  function togglePasswordVisibility(button, field, openIcon, closeIcon) {
      button.addEventListener('click', () => {
        if (openIcon.classList.contains('hidden')) {
          field.type = 'text';
          openIcon.classList.remove('hidden');
          closeIcon.classList.add('hidden');
        } else {
          field.type = 'password';
          openIcon.classList.add('hidden');
          closeIcon.classList.remove('hidden');
        }
      });
    }
  if(passwordb || conpasswordb){
    togglePasswordVisibility(passwordb, passfield, openpass, closepass);
    togglePasswordVisibility(conpasswordb, conpassfield, conopenpass, conclosepass);
  }
  else{
    console.log(" ");
  }
});