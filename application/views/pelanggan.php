                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Data pelanggan</h4>
                            <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addPelanggan"><i
                                class="fas fa-plus fa-sm text-white-500"></i> Tambahkan Pelanggan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Nama <sup>(L/P)</sup></th>
                                            <th>Alamat</th>
                                            <th>Kontak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            $kode = '';
                                            $n_pelanggan = count($data_pelanggan);
                                            if ($n_pelanggan == 0) {
                                                $kode = 'P000';
                                            } else {
                                                $last_id = (int) substr($data_pelanggan[$n_pelanggan-1]->pelanggan_id, 3, 1);
                                                $kode = 'P00'.($last_id + 2);
                                            }
                                            foreach ($data_pelanggan as $pelanggan) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $pelanggan->pelanggan_id ?></td>
                                            <td><?php echo $pelanggan->nama_pelanggan.' ' ?><sup>(<?php echo substr($pelanggan->jeniskelamin, 0, 1) ?>)</sup></td>
                                            <td><?php echo $pelanggan->alamat ?></td>
                                            <td><?php echo $pelanggan->no_hp ?></td>
                                            <td class="action-icons">
                                                <a href="#" data-toggle="modal" data-target="#editPelanggan<?php echo $pelanggan->pelanggan_id ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                                <a href="<?php echo base_url().'pelanggan/delete/'.$pelanggan->pelanggan_id?>"> 
                                                    <i title="hapus" class="fas fa-trash text-lg text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Modal for adding new data -->
            <div class="modal fade" id="addPelanggan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddPelanggan" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddPelangganLabel">Masukan Data Pelanggan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_add_mahasiswa" action="<?php echo base_url().'pelanggan/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">ID</label>
                                    <input type="text" class="form-control" placeholder="ID Pelanggan" autofocus name="pelanggan_id" required readonly value="<?php echo $kode ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Nama </label>
                                    <input type="text" class="form-control" title="Isi nama pelanggan dengan huruf" placeholder='Nama '  name="nama_pelanggan" pattern="[A-Za-z ]{1,50}" required>
                                    <div class="invalid-feedback">
                                    Isi nama pelanggan dengan huruf! (maks. 50 huruf)
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Gender</label>
                                    <select class="form-control" name="jeniskelamin" pattern="[A-Za-z]{1,10}" required>
                                        <option value="">--Please Select--</option>
                                        <option value="Laki">Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                    Pilih jenis kelamin pelanggan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Alamat</label>
                                    <input type="text"  class="form-control" placeholder='Alamat' name="alamat"  required>
                                    <div class="invalid-feedback">
                                    Masukkan alamat pelanggan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Nomor Telepon.</label>
                                    <input type="tel"  class="form-control" placeholder='No Telepon' name="no_hp"  pattern="[0-9]{11,15}" required>
                                    <div class="invalid-feedback">
                                    Isi No. Telepon Pelanggan!
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Batal</button>
                                <button type="submit" class="flex-fill btn btn-success btn-user">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal for editing existing data -->
            <?php
                foreach ($data_pelanggan as $pelanggan) {
            ?>
            <div class="modal fade" id="editPelanggan<?php echo $pelanggan->pelanggan_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditPelanggan" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditPelangganLabel">Ubah Data Pelanggan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_mahasiswa" action="<?php echo base_url().'pelanggan/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">ID</label>
                                    <input type="text" class="form-control" placeholder="ID Pelanggan" autofocus name="pelanggan_id" value="<?php echo $pelanggan->pelanggan_id ?>" readonly>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label text-primary">Nama pelanggan</label>
                                    <input type="text" class="form-control" title="Isi nama pelanggan dengan huruf" placeholder='Nama pelanggan'  name="nama_pelanggan" pattern="[A-Za-z ]{1,50}" value="<?php echo $pelanggan->nama_pelanggan ?>" required>
                                    <div class="invalid-feedback">
                                    Isi nama pelanggan dengan huruf! (maks. 50 huruf)
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label text-primary">Gender</label>
                                    <select class="form-control" name="jeniskelamin" pattern="[A-Za-z]{1,10}" required>
                                        <option value="">--Silahkan pilih--</option>
                                        <option value="Laki" <?php if ($pelanggan->jeniskelamin === 'Laki') { echo "selected"; } ?>>Laki</option>
                                        <option value="Perempuan" <?php if ($pelanggan->jeniskelamin === 'Perempuan') { echo "selected"; } ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                    Pilih jenis kelamin pelanggan!
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label text-primary">Alamat</label>
                                    <input type="text"  class="form-control" placeholder='Alamat' name="alamat"  value="<?php echo $pelanggan->alamat ?>" required>
                                    <div class="invalid-feedback">
                                    Masukkan alamat pelanggan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Nomor Telepon</label>
                                    <input type="tel"  class="form-control" placeholder='Nomor Telepon' name="no_hp" pattern="[0-9]{11,15}" value="<?php echo $pelanggan->no_hp ?>" required>
                                    <div class="invalid-feedback">
                                    Isi No. Telepon Pelanggan!
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Batal</button>
                                <button type="submit" class="flex-fill btn btn-success btn-user">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

            

            