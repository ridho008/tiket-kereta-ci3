$(function() {
	$('.tombolUbahStasiun').click(function() {
		const id = $(this).data('id');
		// console.log(id);

		$.ajax({
			url: 'http://localhost/tiket-kereta-ci3/dashboard/getubah',
			method: 'post',
			dataType: 'json',
			data: {id: id},
			success: function(data) {
				// console.log(data);
				$('#id_stasiun').val(data.id_stasiun);
				$('#stasiun').val(data.nama_stasiun);
			}
		});
	});


	$('.tombolTambahJadwal').click(function() {
		$('#formJadwalModalLabel').html('Tambah Data Jadwal Stasiun');
		$('.modal-footer button[type=submit]').html('Tambah');

	});

	$('.tombolUbahJadwal').click(function() {
		$('#formJadwalModalLabel').html('Ubah Data Jadwal Stasiun');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-body form').attr('action', 'http://localhost/tiket-kereta-ci3/jadwal/ubahjadwal');

		const id = $(this).data('id');
		// console.log(id);

		$.ajax({
			url: 'http://localhost/tiket-kereta-ci3/jadwal/getjadwal',
			method: 'post',
			dataType: 'json',
			data: {id: id},
			success: function(data) {
				// console.log(data);
				$('#id_jadwal').val(data.id_jadwal);
				$('#nama').val(data.nama_kereta);
				$('#asal').val(data.asal);
				$('#tujuan').val(data.tujuan);
				$('#tgl_berangkat').val(data.tgl_berangkat);
				$('#tgl_sampai').val(data.tgl_sampai);
				$('#kelas').val(data.kelas);
			}
		})
	});







});