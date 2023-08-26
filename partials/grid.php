<?php
    $folder = "./uploads"; // images directory
    // Get the directory contents
    $contents = scandir($folder);
    if(!isset($_POST['delete'])){
        $exclude = array('.', '..');
    }
    // Exclude "." and ".." entries
    $files = array_diff($contents, $exclude);
    // Output the list of files
    if(sizeof($files) <= 0){
        echo "<p class='text-[24px] text-gray-300 font-semibold'>No image yet</p>";
    } else {
        foreach ($files as $file) {
            echo "<form class='bg-white shadow-lg flex flex-col justify-between items-start px-2 pt-2 rounded-lg hover:shadow-xl hover:-translate-y-2 duration-200' method='post' id='deletefrm_grid'>";
                echo "<input type='hidden' value='./uploads/$file' name='imagetoDelete'/>";
                echo "<input type='hidden' value='$file' name='imageName'/>";
                echo "<img src='./uploads/$file' class='md:w-[300px] md:h-[300px] h-[150px] w-[250px] object-cover' loading='lazy'/>";
                echo "<button type='submit' name='delete' class='btn btn-error btn-active m-3' id='btnDel'>Delete</button>";
            echo "</form>";
        }
    }
?>