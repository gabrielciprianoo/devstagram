import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: 'Sube tu imagen aqui',
    acceptedFiles: '.png, .jpg, .jpeg',
    addRemoveLinks: true,
    dictRemoveFile: 'Remover Archivo',
    maxFiles: 1,
    uploadMultiple: false,
    
    init: function(){
        if(document.querySelector('[name="image"]').value.trim()){
            const uploadedImage = {};
            uploadedImage.size = 123;
            uploadedImage.name = document.querySelector('[name="image"]').value.trim();

            this.options.addedfile.call(this,uploadedImage);
            this.options.thumbnail.call(this, uploadedImage,`/uploads/${uploadedImage.name}`);

            uploadedImage.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

dropzone.on('success', function(file, response){
    document.querySelector('[name="image"]').value = response.image
});
dropzone.on('removedfile', function(file, response){
    document.querySelector('[name="image"]').value = ""
});


