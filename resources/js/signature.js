import { functions } from "lodash";
import SignaturePad from "signature_pad";

document.addEventListener('DOMContentLoaded' , function () {
    var canvas = document.getElementById("signature-pad");
    var signaturePad = new SignaturePad(canvas);
    //clear Signature
    document.getElementById("clear-signature").addEventListener('click', function () {
        signaturePad.clear();
    });
    //Save Signature as Image
    document.getElementById("save-signature").addEventListener("click", function () {
        if (!signaturePad.isEmpty()) {
            var dataURL = signaturePad.toDataURL(); //img to URL
            var link = document.createElement('a');
            link.href = dataURL;
            link.download = 'signature.png';
            link.click();
        }
        else {
            alert("No signature to save!")
        }
    });
    document.getElementById("upload-signature").addEventListener("click", function () {
        if (!signaturePad.isEmpty()) {
            var dataURL = signaturePad.toDataURL();
        //
            console.log("Signature uploaded:" , dataURL);
            alert("Signature uploaded succesfully!");
        }
        else{
            alert("No signature to upload!");
        }
    })
});
