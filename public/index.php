<?php
require_once __DIR__ . '/../src/phpLeagueTest.php';

if (isset($_POST['filename']) && !empty($_POST['filename']) && isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $object = $filesystem->get('service1/daves_stuff/' . $_POST['filename']);
    header("Content-Type: {$object->getMimetype()}");
    echo $object->read();
    die();
}

if (isset($_POST['action']) && $_POST['action'] == 'upload') {
    $filesystem->write('service1/daves_stuff/' . $_FILES["newFile"]["name"], fopen($_FILES["newFile"]["tmp_name"], 'r'));
}
?>

<html>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="newFile" />
    <input type="hidden" value="upload" name="action" />
    <input type="submit" value="Upload File" />
</form>

<div>
    <form method="post">
        <input type="hidden" value="fetch" name="action" />
        Files on server:
        <table>
            <tr>
                <th>Filename</th>
                <th>Download</th>

                <?php
                    foreach ($folderContent as $object) {
                        ?>
                        <tr>
                            <td><?php echo $object['basename'] ?></td>
                            <td>
                                <input type="hidden" value="<?php echo $object['basename'] ?>" name="filename" />
                                <input type="submit" value="Download" />
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tr>

        </table>
    </form>
</div>

</html>
