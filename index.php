<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File upload</title>
    <link rel="stylesheet" href="./style/custom.css">
    <!-- cdns -->
    <?php require './partials/cdn.php' ?>
</head>
<body class="bg-indigo-400 w-full min-h-screen relative overflow-x-hidden">

    <!-- header -->
    <div class="navbar bg-base-100 shadow-lg flex justify-between fixed top-0 z-[4]">
        <a href="./index.php" class="btn btn-ghost normal-case text-xl">My Gallery</a>
        <div class="flex gap-2">
            <button type="button" class="btn text-[18px]" id="grid"><i class="bi bi-grid-fill"></i></button>
            <button type="button" class="btn text-[18px]" id="stack"><i class="bi bi-layers-fill"></i></button>
        </div>
    </div>

    <!-- modal upload -->
    <div class="hidden justify-center items-center w-full min-h-screen bg-black/30 z-[3] fixed" id="modalUpload">
        <form id="formUpload" enctype="multipart/form-data" class="bg-white p-5 rounded-xl flex flex-col gap-3 w-full max-w-[400px] animate__bounceIn mx-5">
            <div class="flex justify-between">
                <h1>Choose a file</h1>
                <button type="button" class="btn btn-xs bg-gray-100" id="modalClose">X</button>
            </div>

            <label class="custum-file-upload" for="imageInput" id="image">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path> </g></svg>
                    </div>
                    <div class="text">
                    <span id="imageStatus">Click to upload image</span>
                </div>
                <input type="file" accept="image/png, image/gif, image/jpeg" name="uploadFile" id="imageInput">
            </label>

            <button type="submit" name="upload" class="btn btn-success btn-active" id="upload">Upload</button>
        </form>
    </div>

    <div class="mx-[5%] flex items-center justify-center min-h-screen relative" id="uploadedImages">    
        <!-- image delete -->
        <?php
            if(isset($_POST['delete'])) {
                $filePath = $_POST['imagetoDelete'];
                $imageName = $_POST['imageName'];
                $exclude = array('.', '..', $imageName);
                if (unlink($filePath)) {
                    echo "
                    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
                    <script> 
                    swal('Success!', 'Image has been deleted', 'success') 
                    .then(() => { window.location.href = './index.php';}); 
                    </script>";
                }
            }
        ?>

        <!-- Uploaded images here -->
        <!-- grids -->
        <div class="hidden flex-wrap justify-center items-center gap-10 max-w-[1440px] py-[100px]" id="grid_images">
            <?php require './partials/grid.php' ?>
        </div>

        <!-- stacks -->
        <div class="hidden flex-col justify-center items-center gap-10 max-w-[1440px] pt-[100px] w-full relative" id="stack_images">
            <?php require './partials/stacks.php' ?>
        </div>
    </div>

    <!-- btn upload -->
    <button type="button" class="btn btn-success btn-active fixed bottom-[24px] right-[24px] shadow-lg" id="showModalupload">Add photo</button>

    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./index.js"></script>
</body>
</html>