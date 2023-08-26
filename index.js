window.addEventListener("load", function () {
    // show ModalUpload
    $('#showModalupload').click(function () { 
        $('#modalUpload').removeClass('hidden').addClass('flex');
    });

    // close ModalUpload
    $('#modalClose').click(function () { 
        $('#modalUpload').removeClass('flex').addClass('hidden');
    });

    // upload an image
    $('#upload').click(function (e) { 
        e.preventDefault();
        if($('#imageInput').val() !== "") {
            var formData = new FormData($('#formUpload')[0]);
            $.ajax({
                type: "post",
                url: "./php/upload.php",
                data: formData,
                processData: false,  // Prevent jQuery from processing the data
                contentType: false,  // Let the server handle the content type
                success: function (response) {
                    if(response == "Image has been uploaded"){

                        swal("Success!", response, "success")
                        .then(() => {
                            window.location.href = './index.php';
                        });

                        $('#modalUpload').addClass('hidden').removeClass('flex');
                        $('#imageInput').val("");
                    } else {
                        swal("Failed!", response, "error");
                    }
                }
            });
        } else {
            swal("Failed!", "No image selected", "error");
        }
    });

    // image selection
    $('#imageInput').change(function () {
        var image = $('#imageInput').val();
        if($('#imageInput').val() !== "") {
            $('#imageStatus').html('Image is Ready');
            $('#image').addClass('bg-green-500/20');
        }
    });

    // mode
    const grid_images = document.querySelector("#grid_images");
    const stack_images = document.querySelector("#stack_images");
    const stack_btn = document.querySelector("#stack");
    const grid_btn = document.querySelector("#grid");

    stack_btn.addEventListener('click', function () {
        localStorage.mode = "stack";
        checkMode();
    })

    grid_btn.addEventListener('click', function () {
        localStorage.mode = "grid";
        checkMode();
    })

    function checkMode() {
        if(localStorage.mode == null || localStorage.mode == "grid") {
            grid_images.classList.replace('hidden', 'flex');
            stack_images.classList.replace('flex', 'hidden');
            grid_btn.classList.add('bg-indigo-500', 'text-white', 'hover:bg-indigo-600');
            stack_btn.classList.remove('bg-indigo-500', 'text-white', 'hover:bg-indigo-600');
        } else if(localStorage.mode == "stack") {
            stack_images.classList.replace('hidden', 'flex');
            grid_images.classList.replace('flex', 'hidden');
            stack_btn.classList.add('bg-indigo-500', 'text-white', 'hover:bg-indigo-600');
            grid_btn.classList.remove('bg-indigo-500', 'text-white', 'hover:bg-indigo-600');
        }
    }

    checkMode();

    // stack images
    const stackImagesArray = document.querySelectorAll('.myImages');
    const stackImagesArrayLength = stackImagesArray.length;
    const btnNext = document.querySelector('#next');
    const btnPrev = document.querySelector('#prev');
    let stackImagesArrayIndex = 0;

    // button next
    btnNext.addEventListener('click', function() {
        if(stackImagesArrayIndex >= 0 && stackImagesArrayIndex < stackImagesArrayLength - 1) {
            stackImagesArrayIndex++;
            stack();
        } else {
            stackImagesArrayIndex = 0;
            stack();
        }
    })

    // button prev
    btnPrev.addEventListener('click', function() {
        if(stackImagesArrayIndex >= 1 && stackImagesArrayIndex < stackImagesArrayLength) {
            stackImagesArrayIndex--;
            stack();
        } else {
            stackImagesArrayIndex = stackImagesArrayLength - 1;
            stack();
        }
    })

    // 
    function stack() {
        for(let x = 0; x < stackImagesArrayLength; x++) {
            if (stackImagesArrayIndex === x) {
                stackImagesArray[x].classList.replace('hidden', 'flex');
            } else {
                stackImagesArray[x].classList.replace('flex', 'hidden');
            }
        }
    }

    stack();
});