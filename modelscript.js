// Get the modal
var modal = document.getElementById("registrationModal");

// Get the close button
var closeButton = document.getElementsByClassName("close-button")[0];

// Show the modal every time the page is refreshed
modal.style.display = "block";

// When the user clicks on close button, close the modal
closeButton.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
