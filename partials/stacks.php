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
        $id = 1;
        foreach ($files as $file) {
            echo "<form class='bg-white shadow-lg flex flex-col justify-between items-start px-2 pt-2 rounded-lg hover:shadow-xl hidden w-full max-w-[800px] myImages' method='post'>";
                echo "<input type='hidden' value='./uploads/$file' name='imagetoDelete'/>";
                echo "<input type='hidden' value='$file' name='imageName'/>";
                echo "<img src='./uploads/$file' class='object-cover w-full max-w-[800px] md:h-[600px] h-[300px]' loading='lazy'/>";
                echo "<div class='flex justify-between items-center w-full'>";
                    echo "<button type='submit' name='delete' class='btn btn-error btn-active m-3' id='btnDel'>Delete</button>";
                    echo "<p class='text-[18px] font-semibold pr-3'>$id / ".  sizeof($files) . "</p>";
                echo "</div>";
            echo "</form>";
            $id++;
        }
        ?>
            <button type="button" id="prev" class="btn text-[30px] font-bold absolute left-[5%] bg-white/30"><i class="bi bi-arrow-left-circle"></i></button>
            <button type="button" id="next" class="btn text-[30px] font-bold absolute right-[5%] bg-white/30"><i class="bi bi-arrow-right-circle"></i></button>
        <?php
    }
?>