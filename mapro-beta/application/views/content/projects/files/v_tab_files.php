<div class="col-md-2">
    <form action="<?php echo base_url('projects/upload') . '/' . $detail['id_projects']; ?>" id="my-dropzone"
          class="dropzone"
          enctype="multipart/form-data">
        <div class="fallback">
            <input name="file" type="file" multiple/>
        </div>
        <input type="text" hidden="hidden" value="<?php echo $detail['id_projects']; ?>">
    </form>
</div>
<div class="col-md-10">
    <h4><b>Available Files:</b></h4>
    <ol id="download-list">
        <?php
        $foldername = 'assets/uploads/' . $detail['id_projects'];
        if (!is_dir($foldername)) {
            mkdir('./' . $foldername, 0777, TRUE);
        }
        $files = get_dir_file_info($foldername, $top_level_only = TRUE);
        //    echo var_dump($files);
        $downloads = array();
        foreach ($files as $file) {
            $imageUrl = base_url('assets/uploads') . '/' . $detail['id_projects'] . '/' . $file['name'];
            echo '<li><a href="' . $imageUrl . '">' . $file['name'] . '</a></li>';
        }
        ?>
    </ol>
</div>

<script type="application/javascript">
    Dropzone.autoDiscover = false;
    $(function () {
        // Now that the DOM is fully loaded, create the dropzone, and setup the
        // event listeners
        const myDropzone = new Dropzone("#my-dropzone");
        const baseUrl = "<?php echo base_url('assets/uploads') . '/' . $detail['id_projects'];?>";
        myDropzone.on("success", function (file, response) {
//            console.log("Uploaded file " + JSON.stringify(file));
//            console.log("Response: " + JSON.stringify(response));
            const fileName = JSON.parse(response).upload_data.file_name;
            $("#download-list").append($('<li><a href="' + baseUrl + '/' + fileName + '">' + fileName + '</a></li>'));
        });
        myDropzone.on("error", function (file, errorMessage) {
            console.log("Upload failed for file " + JSON.stringify(file));
        });
    });
</script>