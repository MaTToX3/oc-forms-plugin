function onSuccess() {
  document.getElementById("novelus-form").reset();

  if (document.getElementsByClassName('g-recaptcha').length > 0) {
    grecaptcha.reset();
  }
}
