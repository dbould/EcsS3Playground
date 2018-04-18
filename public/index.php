<?php
require_once __DIR__ . '/../src/phpLeagueTest.php';

if (isset($_GET['filename']) && !empty($_GET['filename']) && isset($_GET['action']) && $_GET['action'] == 'fetch') {
    $object = $filesystem->get('service1/daves_stuff/' . $_GET['filename']);
    header("Content-Type: {$object->getMimetype()}");
    echo $object->read();
    die();
}

if ($_POST['action'] == 'upload') {
    $filesystem->write('service1/daves_stuff/' . $_FILES["newFile"]["name"], fopen($_FILES["newFile"]["tmp_name"], 'r'));
}
?>

<html>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="newFile" />
    <input type="hidden" value="upload" name="action" />
    <input type="submit" value="Upload File" />
</form>
Upload a file: <button>Upload</button>

<div>
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
                            <input type="button" value="Download"
                                   onclick="window.open('http://ecsprototype.test?action=fetch&filename=<?php echo $object['basename'] ?>')">
                            </input>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tr>

    </table>
</div>

</html>
