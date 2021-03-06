<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>
<body id="page-top">
	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">
		<?php $this->load->view("admin/_partials/sidebar.php") ?>
		<div id="content-wrapper">
			<div class="container-fluid">
				<?php $this->load->view("admin/_partials/breadcumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('diskon/tambah') ?>"><i class="fas fa-plus"></i> Tambah Data Baru</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>kode</th>
										<th>Nama</th>
										<th>Rate</th>
										<th>Operasi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1?>
									<?php foreach ($record as $r): ?>
										<tr>
											<td><?php echo $no ?></td>
											<td width="150"><?php echo $r->kode_diskon ?></td>
											<td><?php echo $r->nama_diskon ?></td>
											<td><?php echo $r->rate_diskon ?></td>
											<td width="250">
												<a href="<?php echo site_url('diskon/ubah/'.$r->id_diskon) ?>"
												 class="btn btn-small"><i class="fas fa-edit"></i> Ubah</a>
												<a onclick="deleteConfirm('<?php echo site_url('diskon/hapus/'.$r->id_diskon) ?>')"
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