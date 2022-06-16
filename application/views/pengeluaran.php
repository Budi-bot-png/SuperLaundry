                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Data Pengeluaran</h4>
                            <div class="d-flex">
                                <a href="<?php echo base_url()?>pengeluaran/bayar_gaji" class="mr-2 btn btn-warning shadow-sm"><i
                                class="fas fa-wallet fa-sm text-white-500"></i> Bayar Gaji Karyawan</a>
                                <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addPengeluaran"><i
                                    class="fas fa-plus fa-sm text-white-500"></i> Tambahkan Pengeluaran</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>ID pengeluaran</th>
                                            <th>Rincian</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                            <th>Karyawan</th>
                                            <th class="actions">Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data_pengeluaran as $pengeluaran) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $pengeluaran->pengeluaran_id ?></td>
                                            <td><?php echo $pengeluaran->detail ?></td>
                                            <td>Rp <?php echo $pengeluaran->total ?></td>
                                            <td><?php echo $pengeluaran->tgl_pengeluaran ?></td>
                                            <td>
                                                <span class="row px-3 text-primary text-xs"><?php echo $pengeluaran->karyawan_id ?></span>
                                                <span class="row px-3"><?php echo $pengeluaran->nama_karyawan ?></span>
                                            </td>
                                            <td class="action-icons">
                                                <a href="#" data-toggle="modal" data-target="#editPengeluaran<?php echo $no-1 ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                                <a href="<?php echo base_url().'pengeluaran/delete/'.$pengeluaran->pengeluaran_id?>"> 
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
            <div class="modal fade" id="addPengeluaran" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddPengeluaran" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddPengeluaranLabel">Masukan Data Pengeluaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_add_transaksi" action="<?php echo base_url().'pengeluaran/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label text-primary">Detail</label>
                                    <input type="text"  class="form-control" placeholder='Rincian Pengeluaran' name="detail"  required>
                                    <div class="invalid-feedback">
                                    Isi rincian pengeluaran!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Total</label>
                                    <input type="number"  class="form-control" placeholder='Total pengeluaran' name="total"  required>
                                    <div class="invalid-feedback">
                                    Isi total pengeluaran!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Karyawan</label>
                                    <select class="form-control" name="karyawan_id" required>
                                        <option value="">--Silahkan Pilih--</option>
                                        <?php
                                            foreach ($data_karyawan as $karyawan) {
                                                if ($karyawan->aktif == 1) {
                                        ?>
                                        <option value="<?php echo $karyawan->karyawan_id ?>">
                                            <?php echo $karyawan->karyawan_id.' '.$karyawan->nama_karyawan ?>
                                        </option>
                                        <?php }} ?>
                                    </select>
                                    <div class="invalid-feedback">
                                    Pilih identitas karyawan!
                                    </div>
                                </div>
 
                                <div class="form-group">
                                    <label class="control-label text-primary">Tanggal Pengeluaran</label>
                                    <input type="date"  class="form-control" placeholder='Tanggal Pengeluaran' name="tgl_pengeluaran" required>
                                    <div class="invalid-feedback">
                                    Masukkan tanggal pengeluaran!
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
                $no = 1;
                foreach ($data_pengeluaran as $pengeluaran) {
            ?>
            <div class="modal fade" id="editPengeluaran<?php echo $no ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditPengeluaran" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditPengeluaranLabel">Ubah Data Pengeluaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_matakuliah" action="<?php echo base_url().'pengeluaran/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body">                                 
                                <div class="form-group d-none">
                                    <label class="control-label text-primary">ID pengeluaran</label>
                                    <input type="text"  class="form-control" name="pengeluaran_id" value="<?php echo $pengeluaran->pengeluaran_id ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Rincian</label>
                                    <input type="text"  class="form-control" placeholder='Rincian Pengeluaran' name="detail" value="<?php echo $pengeluaran->detail ?>" required>
                                    <div class="invalid-feedback">
                                    Isi rincian pengeluaran!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Total</label>
                                    <input type="number"  class="form-control" placeholder='Total pengeluaran' name="total" value="<?php echo $pengeluaran->total ?>" required>
                                    <div class="invalid-feedback">
                                    Isi total pengeluaran!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Karyawan</label>
                                    <select class="form-control" name="karyawan_id" required>
                                        <option value="">--Silahkan Pilih--</option>
                                        <?php
                                            foreach ($data_karyawan as $karyawan) {
                                                if ($karyawan->aktif == 1) {
                                        ?>
                                        <option value="<?php echo $karyawan->karyawan_id ?>" <?php if ($karyawan->karyawan_id === $pengeluaran->karyawan_id) { echo "selected"; } ?>>
                                            <?php echo $karyawan->karyawan_id.' '.$karyawan->nama_karyawan ?>
                                        </option>
                                        <?php }} ?>
                                    </select>
                                    <div class="invalid-feedback">
                                    Pilih identitas karyawan!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Tanggal Pengeluaran</label>
                                    <input type="date"  class="form-control" placeholder='Tanggal Pengeluaran' name="tgl_pengeluaran" value="<?php echo $pengeluaran->tgl_pengeluaran ?>" required>
                                    <div class="invalid-feedback">
                                    Masukkan tanggal pengeluaran!
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
                $no++;
                }
            ?>