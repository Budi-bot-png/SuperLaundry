                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Laporan Data Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <form name="form_filter_karyawan" action="<?php echo base_url().'karyawan/laporan_filter' ?>" method="post" class="w-50 user needs-validation mx-3 mb-4" novalidate>
                                <h5>Aktif pada rentang waktu</h5>
                                <div class="form-group">
                                    <label class="control-label text-primary">Dari</label>
                                    <input type="date"  class="form-control" name="dari" value="<?php echo set_value('dari')?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Sampai</label>
                                    <input type="date"  class="form-control" name="sampai" value="<?php echo set_value('sampai')?>" required>
                                </div>
                                <button type="submit" class="flex-fill btn btn-primary btn-user px-4">Cari</button>
                            </form>

                            <div class="d-flex m-3">
                                <a target="blank" href="<?php echo base_url().'karyawan/print/'.set_value('dari').'/'.set_value('sampai') ?>" class="btn btn-secondary shadow-sm"><i
                                class="fas fa-print fa-sm text-white-500"></i> Print</a>
                                <a target="blank" href="<?php echo base_url().'karyawan/cetak_pdf/'.set_value('dari').'/'.set_value('sampai') ?>" class="btn btn-danger shadow-sm mx-2" ><i
                                class="fas fa-file fa-sm text-white-500" ></i> Print PDF</a>
                            </div>

                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>No.</th>
                                            <th>ID</th>
                                            <th>Nama karyawan</th>
                                            <th>Alamat</th>
                                            <th>Kontak</th>
                                            <th>Gaji/bulan</th>
                                            <th>Bergabung</th>
                                            <th>Berhenti</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data_karyawan as $karyawan) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $karyawan->karyawan_id ?></td>
                                            <td><?php echo $karyawan->nama_karyawan.' ' ?><sup>(<?php echo substr($karyawan->jeniskelamin, 0, 1) ?>)</sup></td>
                                            <td><?php echo $karyawan->alamat ?></td>
                                            <td><?php echo $karyawan->no_hp ?></td>
                                            <td>Rp <?php echo $karyawan->gaji_perbulan ?></td>
                                            <td><?php echo $karyawan->tgl_bergabung ?></td>
                                            <td><?php if ($karyawan->tgl_berhenti == '0000-00-00') { echo '-'; } else { echo $karyawan->tgl_berhenti; } ?></td>
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

            

            