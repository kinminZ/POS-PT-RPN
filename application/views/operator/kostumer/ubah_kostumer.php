<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("operator/_partials/head.php") ?>
</head>
<body id="page-top" onload="setInterval('displayServerTime()', 1000);">
	<?php $this->load->view("operator/_partials/navbar.php") ?>
	<div id="wrapper">
		<?php $this->load->view("operator/_partials/sidebar.php") ?>
		<div id="content-wrapper">
			<div class="container-fluid">

				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('kostumer') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
						<form action="<?php base_url('kostumer/ubah') ?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $record['id_kostumer'] ?>">
							<div class="form-group">
								<label for="nama">Nama Lengkap*</label>
								<input class="form-control type="text" name="nama_kostumer" value="<?php echo $record['nama_kostumer'] ?>"/>
							</div>

							<div class="form-group">
								<label for="harga">Kontak*</label>
								<input class="form-control type="text" name="kontak"value="<?php echo $record['kontak'] ?>" />
							</div>

							<div class="form-group">
								<label for="harga">Alamat Lengkap*</label>
								<input class="form-control type="text" name="alamat" value="<?php echo $record['alamat'] ?>" />
							</div>

							<div class="form-group">
								<label for="harga">Kode Pos*</label>
								<input class="form-control type="text" name="kode_pos" value="<?php echo $record['kode_pos'] ?>" />
							</div>
							<button class="btn btn-success" type="submit" name="submit">Ubah</button>
						</form>
					</div>
					<div class="card-footer small text-muted">
						* required fields
					</div>
				</div>
				<!-- /.container-fluid-->

				<!-- Sticky Footer-->
				<?php $this->load->view('operator/_partials/footer.php') ?>
			</div>
			<!-- /.content-wrapper-->
		</div>
		<!-- /#wrapper-->

	</div>
	<?php $this->load->view('operator/_partials/scrolltop.php') ?>
	<?php $this->load->view('operator/_partials/js.php') ?>
</body>
</html>