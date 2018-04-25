<?php
require_once __DIR__ . '/../src/phpLeagueTest.php';

if (isset($_POST['filename']) && !empty($_POST['filename']) && isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $object = $filesystem->get('daves_stuff/' . $_POST['filename']);
    header("Content-Type: {$object->getMimetype()}");
    echo $object->read();
    die();
}

if (isset($_POST['action']) && $_POST['action'] == 'upload') {
    $filesystem->write('daves_stuff/' . $_FILES["newFile"]["name"], fopen($_FILES["newFile"]["tmp_name"], 'r'));
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
                <th>Direct Link</th>

                <?php
                    foreach ($folderContent as $object) {
                        ?>
                        <tr>
                            <td><?php echo $object['basename'] ?></td>
                            <td>
                                <input type="radio" value="<?php echo $object['basename'] ?>" name="filename" />
                            </td>
                            <td><a href="<?php echo $client->getObjectUrl($configuration->bucket, $object['path']);?>">Download</a></td>
                        </tr>
                        <?php
                    }
                ?>
            </tr>

        </table>

        <input type="submit" value="Download" />
    </form>
</div>

</html>
