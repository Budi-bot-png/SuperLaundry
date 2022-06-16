                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Data karyawan</h4>
                            <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addKaryawan"><i
                                class="fas fa-plus fa-sm text-white-500"></i> Tambahkan Karyawan</a>
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
                                            <th>Gaji</th>
                                            <th>Tanggal Bergabung</th>
                                            <th>Tanggal Akhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            $kode = '';
                                            $n_karyawan = count($data_karyawan);
                                            if ($n_karyawan == 0) {
                                                $kode = 'K001';
                                            } else {
                                                $last_id = (int) substr($data_karyawan[$n_karyawan-1]->karyawan_id, 3, 1);
                                                $kode = 'K00'.($last_id+1);
                                            }
                                            foreach ($data_karyawan as $karyawan) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $karyawan->karyawan_id ?></td>
                                            <td><?php echo $karyawan->nama_karyawan.' ' ?><sup>(<?php echo substr($karyawan->jeniskelamin, 0, 1) ?>)</sup><br>
                                                <?php if ($karyawan->aktif == 1) { ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php } else if ($karyawan->aktif == 2) { ?>
                                                    <span class="badge badge-info">Business Owner</span>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $karyawan->alamat ?></td>
                                            <td><?php echo $karyawan->no_hp ?></td>
                                            <td><?php if ($karyawan->karyawan_id == 'K000') { echo '----'; } else { echo 'Rp '.$karyawan->gaji_perbulan; } ?></td>
                                            <td><?php echo $karyawan->tgl_bergabung ?></td>
                                            <td><?php if ($karyawan->tgl_berhenti == '0000-00-00') { echo '----'; } else { echo $karyawan->tgl_berhenti; } ?></td>
                                            <td class="action-icons">
                                                <a href="#" data-toggle="modal" data-target="#editKaryawan<?php echo $karyawan->karyawan_id ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                                <?php if ($karyawan->karyawan_id != 'K000') { ?>
                                                <a href="<?php echo base_url().'karyawan/delete/'.$karyawan->karyawan_id?>"> 
                                                    <i title="hapus" class="fas fa-trash text-lg text-danger"></i>
                                                </a>
                                                <?php } ?>
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
            <div class="modal fade" id="addKaryawan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddKaryawan" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddKaryawanLabel">Masukkan data Karyawan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_add_mahasiswa" action="<?php echo base_url().'karyawan/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">ID</label>
                                    <input type="text" class="form-control" placeholder="ID Karyawan" autofocus name="karyawan_id" required readonly value="<?php echo $kode ?>">
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Nama Karyawan</label>
                                    <input type="text" class="form-control" title="Isi Nama Pegawai dengan Huruf" placeholder='Nama Karyawan'  name="nama_karyawan" pattern="[A-Za-z ]{1,50}" required>
                                    <div class="invalid-feedback">
                                    Isikan nama pegawai dengan huruf! (maks. 50 huruf)
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Jenis kelamin</label>
                                    <select class="form-control" name="jeniskelamin" pattern="[A-Za-z]{1,10}" required>
                                        <option value="">--Silahkan pilih--</option>
                                        <option value="Laki">Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                    Pilih jenis kelamin karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Alamat</label>
                                    <input type="text"  class="form-control" placeholder='Alamat Karyawan' name="alamat"  required>
                                    <div class="invalid-feedback">
                                    Isi alamat karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Nomor handphone</label>
                                    <input type="tel"  class="form-control" placeholder='Nomor Ponsel Karyawan' name="no_hp"  pattern="[0-9]{11,15}" required>
                                    <div class="invalid-feedback">
                                    Isi No. HP Karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Gaji per bulan</label>
                                    <input type="number"  class="form-control" placeholder='Gaji Karyawan per bulan' name="gaji_perbulan"  required>
                                    <div class="invalid-feedback">
                                    Isi gaji bulanan karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Tanggal Bergabung</label>
                                    <input type="date"  class="form-control" placeholder='Tanggal Bergabung Karyawan' name="tgl_bergabung" required>
                                    <div class="invalid-feedback">
                                    Isi tanggal bergabung menjadi karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Tanggal Berhenti</label>
                                    <input type="date"  class="form-control" placeholder='Tanggal Karyawan berhenti' name="tgl_berhenti">
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
                foreach ($data_karyawan as $karyawan) {
            ?>
            <div class="modal fade" id="editKaryawan<?php echo $karyawan->karyawan_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditKaryawan" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditKaryawanLabel">Change Employee data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_mahasiswa" action="<?php echo base_url().'karyawan/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">ID</label>
                                    <input type="text" class="form-control" placeholder="Emp ID" autofocus name="karyawan_id" value="<?php echo $karyawan->karyawan_id ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Nama Karyawan</label>
                                    <input type="text" class="form-control" title="Isi Nama Pegawai dengan Huruf" placeholder='Nama Karyawan'  name="nama_karyawan" pattern="[A-Za-z ]{1,50}" value="<?php echo $karyawan->nama_karyawan ?>" required>
                                    <div class="invalid-feedback">
                                    Isikan nama pegawai dengan huruf! (maks. 50 huruf)
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Jenis Kelamin</label>
                                    <select class="form-control" name="jeniskelamin" pattern="[A-Za-z]{1,10}" required>
                                        <option value="">--Silahkan pilih--</option>
                                        <option value="Laki" <?php if ($karyawan->jeniskelamin === 'Laki') { echo "selected"; } ?>>Laki</option>
                                        <option value="Perempuan" <?php if ($karyawan->jeniskelamin === 'Perempuan') { echo "selected"; } ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                    Pilih jenis kelamin karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Alamat</label>
                                    <input type="text"  class="form-control" placeholder='Alamat Karyawan' name="alamat"  value="<?php echo $karyawan->alamat ?>" required>
                                    <div class="invalid-feedback">
                                    Isi alamat karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Nomor Handphone</label>
                                    <input type="tel"  class="form-control" placeholder='Nomor Ponsel Karyawan' name="no_hp" pattern="[0-9]{11,15}" value="<?php echo $karyawan->no_hp ?>" required>
                                    <div class="invalid-feedback">
                                    Isi No. HP Karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Gaji per bulan</label>
                                    <input type="number"  class="form-control" placeholder='Gaji Karyawan per bulan' name="gaji_perbulan" value="<?php echo $karyawan->gaji_perbulan ?>" required>
                                    <div class="invalid-feedback">
                                    Isi gaji bulanan karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Tanggal Bergabung</label>
                                    <input type="date"  class="form-control" placeholder='Tanggal Bergabung Karyawan' name="tgl_bergabung" value="<?php echo $karyawan->tgl_bergabung ?>" required>
                                    <div class="invalid-feedback">
                                    Fill in the date of joining the employee!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Tanggal Berhenti</label>
                                    <input type="date"  class="form-control" placeholder='Tanggal Karyawan Berhenti' name="tgl_berhenti" value="<?php echo $karyawan->tgl_berhenti ?>">
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

            

            