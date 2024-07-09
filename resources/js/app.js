import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

Dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: 'Sube tu imagen aqui',
    acceptedFiles: '.png, .jpg, .jpeg',
    addRemoveLinks: true,
    dictRemoveFile: 'Remover Archivo',
    maxFiles: 1,
    uploadMultiple: false
});
