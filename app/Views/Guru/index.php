<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $tajuk; ?></h1>

    <div class="swal" data-swal="<?= session()->get('message'); ?>"></div>

    <div class="row">
        <div class="col-md-8">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger p-0 pt-2' role='alert'>" . session()->get('err') . "</div>";
                session()->remove('err');
            }
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"> Tambah Data</i>
            </button>
        </div>
        <div class="col-4">
        <?= $pager->links('guru', 'bootstrap_pagination'); ?>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>NIP</th>
                <th>NAMA</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($guru)) : ?>
            <?php $i = 1; ?>
            <?php foreach ($guru as $row) : ?>
                <tr>
                    <td scope="row"><?= $i++; ?></td>
                    <td><img width="50" src="<?= '/assets/img/profile/' . $row['gambar']; ?>" class="rounded"></td>
                    <td><?= $row['nip']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#modalUbah" id="btn-edit" class="btn btn-sm btn-warning" data-id="<?= $row['id']; ?>" data-nip="<?= $row['nip']; ?>" data-nama="<?= $row['nama']; ?>"> <i class="fa fa-edit"></i> </button>
                        <a href="/guru/hapus/<?= $row['id']; ?>" class="btn btn-sm btn-danger btn-hapus"> <i class="fa fa-trash-alt"></i> </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <td colspan="5"> 
                    <h1 class="text-gray-500 text-center">Data Tiada</h1>
                </td>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Box Tambah Data Guru -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $tajuk; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('guru/tambah'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-2">
                        <input type="file" name="gambar" class="dropify" data-length="100">
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan nip">
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama guru">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>