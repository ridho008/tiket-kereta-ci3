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
});