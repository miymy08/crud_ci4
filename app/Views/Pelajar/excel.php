<?php 
header("Content-type: applicatoion/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Siswa.xls");
?>

<html>
    <body>
    <table border="1" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Matrik</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($pelajar->getResultArray() as $row) : ?>
                <tr>
                    <td scope="row"><?= $i; ?></td>
                    <td><?= $row['matric_no']; ?></td>
                    <td><?= $row['nama']; ?></td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
            </table>
    </body>
</html>