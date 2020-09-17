<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $tajuk; ?></h1>

    <!-- <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        Data Pelajar Berjaya <strong><?= session()->getFlashdata('message'); ?></strong>
        </div>
    <?php endif; ?> -->

    <div class="swal" data-swal="<?= session()->get('message'); ?>"></div>

    <div class="row">
        <div class="col-md-6">
            <?php 
            if (session()->get('err')){
                echo "<div class='alert alert-danger' role='alert'". session()->get('err')."</div>";
                session()->remove('err');
            }
            ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                        <i class="fa fa-plus"> Tambah Data</i> 
                    </button>
                </div>
                <div class="col-md">
                    <button onclick="window-print()" class="btn btn-outline-secondary shadow float-right">Print <i class="fa fa-print"></i></button>
                    <a href="/pelajar/excel" class="btn btn-outline-success shadow float-right">Excel <i class="fa fa-file-excel"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Matrik</th>
                    <th>Nama</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($pelajar->getResultArray() as $row) : ?>
                <tr>
                    <td scope="row"><?= $i; ?></td>
                    <td><?= $row['matric_no']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#modalUbah" class="btn btn-sm btn-warning" 
                            id="btn-edit" 
                            data-id="<?= $row['id']; ?>" 
                            data-nama="<?= $row['nama']; ?>" 
                            data-matric_no="<?= $row['matric_no']; ?>"><i class="fa fa-edit"></i>
                        </button>
                        <!-- <button type="button" data-toggle="modal" data-target="#modalHapus" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash-alt"></i>
                        </button> -->
                        <a href="/pelajar/hapus/<?= $row['id']; ?>" class="btn btn-sm btn-danger btn-hapus">
                            <i class="fa fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- modal tambah -->
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
                <form action="<?= base_url('pelajar/tambah'); ?>" method="post">
                <div class="form-group mb-0">
                    <label for="matric_no"></label>
                    <input type="text" name="matric_no" id="matric_no" class="form-control" placeholder="Masukkan No.Matrik">
                </div>
                <div class="form-group mb-0">
                    <label for="nama"></label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Pelajar">
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

<!-- modal delete -->
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Adakah anda pasti untuk buang data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <a href="/pelajar/hapus/<?= $row['id']; ?>" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- modal ubah -->
<div class="modal fade" id="modalUbah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah <?= $tajuk; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pelajar/ubah'); ?>" method="post">
                <input type="text" name="id" id="id-pelajar" hidden>
                <div class="form-group mb-0">
                    <label for="matric_no"></label>
                    <input type="text" name="matric_no" id="matric_no" class="form-control" placeholder="Masukkan No.Matrik" 
                    value="<?= $row['matric_no'] ?>">
                </div>
                <div class="form-group mb-0">
                    <label for="nama"></label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Pelajar"
                    value="<?= $row['nama'] ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>