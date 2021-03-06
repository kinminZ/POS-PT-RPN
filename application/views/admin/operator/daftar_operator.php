<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>
<body id="page-top" onload="setInterval('displayServerTime()', 1000);">
	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">
		<?php $this->load->view("admin/_partials/sidebar.php") ?>
		<div id="content-wrapper">
			<div class="container-fluid">
				<?php $this->load->view("admin/_partials/breadcumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('operator/tambah') ?>"><i class="fas fa-plus"></i> Tambah Data Baru</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Lengkap</th>
										<th>Username</th>
										<th>Cabang</th>
										<th>Login terakhir</th>
										<th>Operasi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1?>
									<?php foreach ($record->result() as $r): ?>
										<tr>
											<td><?php echo $no ?></td>
											<td width="150"><?php echo $r->nama_lengkap ?></td>
											<td><?php echo $r->username ?></td>
											<td><?php echo $r->nama_cabang ?></td>
											<td><?php echo $r->login_terakhir ?></td>
											<td width="250">
												<a href="<?php echo site_url('operator/ubah/'.$r->id_operator) ?>"
												 class="btn btn-small"><i class="fas fa-edit"></i> Ubah</a>
												<a onclick="deleteConfirm('<?php echo site_url('operator/hapus/'.$r->id_operator) ?>')"
												 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
											</td>
										</tr>
										<?php $no++; ?>
									<?php endforeach; ?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("admin/_partials/footer.php") ?>
		</div>
		<!-- /.content-wrapper -->
	</div>
	<!-- /#wrapper -->

	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>
	<?php $this->load->view("admin/_partials/js.php") ?>

	<script>
		function deleteConfirm(url) {
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>
</body>
</html>