<body class="bg-gradient-danger">

    <div class="container py-5 mt-5">
    	<div class="alert-container">
			<div class="alert alert-light text-dark alert-dismissible fade show w-75 m-auto" role="alert" >
				<h3 class="alert-heading my-2 text-danger font-weight-bold">Hapus Data Gagal!</h3>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick=location.href="<?php echo base_url().$datatype.'/form_add'?>">
					<span aria-hidden="true">&times;</span>
				</button>
				<p class="lead">Data gagal dihapus dari database.</p>
				<hr>
				<p class="mb-0">Data yang Anda masukkan sudah ada di database, atau coba periksa kembali koneksi database Anda.</p>
				<img class="illustration" src="<?php echo base_url().'assets/img/undraw_cancel.svg' ?>">
			</div>	
		</div>
	</div>
</div>
<!-- End of Main Content -->