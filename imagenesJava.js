var images = [
    "imagenes/imagen.jpg",
    "imagenes/imagen2.jpg",
    "imagenes/imagen3.jpg",
    "imagenes/imagen4.jpg",
    "imagenes/imagen5.jpg",
    "imagenes/imagen6.jpg",
    "imagenes/imagen7.jpg",
    "imagenes/imagen8.jpg",
    "imagenes/imagen9.jpg",
    "imagenes/imagen10.jpg",
    "imagenes/imagen11.jpg",
    "imagenes/imagen12.jpg",
    "imagenes/imagen13.jpg",
    "imagenes/imagen14.jpg",
    "imagenes/imagen15.jpg",
    "imagenes/imagen16.jpg",
    "imagenes/imagen17.jpg",
    "imagenes/imagen18.jpg",
    "imagenes/imagen19.jpg",
    "imagenes/imagen20.jpg",
    "imagenes/imagen21.jpg",
    "imagenes/imagen22.jpg"
];

var currentIndex = 0;
var selectedImages = [];

function showImage() {
  var imageElement = document.getElementById("image");
  imageElement.src = images[currentIndex];

  // Reiniciar clase seleccionada
  var prevSelectedImage = document.querySelector(".selected");
  if (prevSelectedImage) {
    prevSelectedImage.classList.remove("selected");
  }

  // Agregar clase seleccionada a la imagen actual
  imageElement.classList.add("selected");
}

function previousImage() {
  currentIndex--;
  if (currentIndex < 0) {
    currentIndex = images.length - 1;
  }
  showImage();
}

function nextImage() {
  currentIndex++;
  if (currentIndex >= images.length) {
    currentIndex = 0;
  }
  showImage();
}


function selectImage() {
    var selectedImage = images[currentIndex];
    if (selectedImages.length < 4 && !selectedImages.includes(selectedImage)) {
      selectedImages.push(selectedImage);
      addSelectedImageElement(selectedImage);
      updateSelectedImagesInput();
  
      var selectedImageElements = document.querySelectorAll("#selectedImagesContainer img");
      selectedImageElements.forEach(function(imageElement) {
        imageElement.classList.remove("selected");
      });
  
      var lastSelectedImageElement = selectedImageElements[selectedImageElements.length - 1];
      lastSelectedImageElement.classList.add("selected");
    }
}

function validateForm() {
    if (selectedImages.length !== 4) {
      alert("Debes seleccionar exactamente 4 imágenes.");
      return false; // Evita que se envíe el formulario
    }
    return true; // Permite el envío del formulario si se han seleccionado 4 imágenes
}  

function addSelectedImageElement(imagePath) {
    var selectedImagesContainer = document.getElementById("selectedImagesContainer");
    var imageElement = document.createElement("img");
    imageElement.src = imagePath;
    selectedImagesContainer.appendChild(imageElement);
}

function updateSelectedImagesInput() {
    var selectedImagesInput = document.getElementById("selectedImages");
    selectedImagesInput.value = selectedImages.join(",");
}

document.addEventListener("DOMContentLoaded", showImage);
