
    <h1>E-Archive</h1>
    <?php
    foreach($archive_list as $arsip){
    ?>
        <?php echo $arsip['document_type'];?>
        <?php echo $arsip['document_name'];?>
        <?php echo $arsip['file_type'];?>
        <?php echo $arsip['archive_date'];?>
    <?php
    }
    ?>