<!DOCTYPE html>
<html><head>
    <title></title>
    <style>
    body {
    	width: 90%;
    	margin: auto;
    }

    table {
		border: 1px solid #ddd;
		width: 100%;
		margin-top: 20px;
		margin-bottom: 12px;
		border-collapse: collapse;
		text-align: left;
	}

	td, th {
		border: 1px solid #ddd;
		padding: 12px;
	}

	table th {
		font-weight: bold;
		text-align: left;
	}

	span {
		margin-left: 20px;
	}

	.center {
		text-align: center;
	}

	#no {
		width: 30px;
	}

	</style>
</head><body>
	<h5>SUPERLAUNDRY</h5>
	<h1>Laporan Data Karyawan</h1>
	<?php 
		echo '<p>Karyawan aktif pada rentang waktu</p>';
		echo '<p>Dari: '.$dari.'<span>Sampai: '.$sampai.'</span></p>';
	?>
    <table>
		<tr>
			<th class="center" id="no">#</th>
            <th class="center">ID</th>
            <th>Nama Karyawan</th>
            <th>Kelamin</th>
            <th>Alamat</th>
            <th>Kontak</th>
            <th>Gaji/bulan</th>
            <th>Gabung</th>
            <th>Berhenti</th>
		</tr>
		<?php
            $no = 1;
            foreach ($data_karyawan as $karyawan) {
        ?>
        <tr>
            <th class="center"><?php echo $no++ ?></th>
            <td class="center"><?php echo $karyawan->karyawan_id ?></td>
            <td><?php echo $karyawan->nama_karyawan ?></td>
            <td><?php echo $karyawan->jeniskelamin ?></td>
            <td><?php echo $karyawan->alamat ?></td>
            <td><?php echo $karyawan->no_hp ?></td>
            <td>Rp <?php echo $karyawan->gaji_perbulan ?></td>
            <td><?php echo $karyawan->tgl_bergabung ?></td>
            <td><?php if ($karyawan->tgl_berhenti == '0000-00-00') { echo '-'; } else { echo $karyawan->tgl_berhenti; } ?></td>
		</tr>
		<?php 
			}
		?>
	</table>
	<p>Note: Year-month-day time format (yyyy-mm-dd)</p>
	<script type="text/javascript">
		window.print();
	</script>
</body></html>