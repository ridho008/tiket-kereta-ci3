$(function() {
	$('[data-toggle="tooltip"]').tooltip();
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

	// $('.bagianA').hide();
	// $('.bagianB').hide();
	// var URL='http://localhost/tiket-kereta-ci3/tamu/konfirmasi';

	// var arr=URL.split('/');//arr[0]='http://localhost'
	//                        //arr[1]='tiket-kereta-ci3'
	//                        //arr[2]='tamu'
	//                        //arr[3]='konfirmasi'

	// var parameter=arr[arr.length-1].split('/');//parameter[0]='konfirmasi'

	// var p_value=parameter[0].split('/')[0];//p_value='10';
	// console.log(p_value);                                          //parameter[1]='p=10'

	// if(p_value === 'konfirmasi') {
	// 	$('.bagian').change(function() {
	// 		var bagian = $('.bagian').val();
	// 		var bagianA = $('.bagianA');
	// 		var bagianB = $('.bagianB');

	// 		if(bagian == 'a') {
	// 			$('.bagianA').show();
	// 			$('#judulBagianA').html('-- Pilih Bagian A --');
	// 			$('.bagianB').hide();
	// 		} else if(bagian == 'b') {
	// 			$('.bagianB').show();
	// 			$('#judulBagianB').html('-- Pilih Bagian B --');
	// 			$('.bagianA').hide();
	// 		}
	// 	});

		
	// }


	// $('.pilih-gerbong').on('change', function() {
	// 	var gambarGerbong = $('.gambar-gerbong');
	// 	var pilihGerbong = $('.pilih-gerbong').val();

	// 	if(pilihGerbong == '1') {
	// 		$(gambarGerbong).attr('src', 'http://localhost/tiket-kereta-ci3/assets/img/gerbong/index.jpeg');
	// 	} else if(pilihGerbong == '2') {
	// 		$(gambarGerbong).attr('src', 'http://localhost/tiket-kereta-ci3/assets/img/gerbong/gerbong1.jpg');
	// 	} else if(pilihGerbong == '2') {
	// 		$(gambarGerbong).attr('src', 'http://localhost/tiket-kereta-ci3/assets/img/gerbong/index.jepg');
	// 	}
	// });

	
	// $('.bagian').change(function() {
	// 	var bagian = $('.bagian').val();
	// 	var bagianA = $('.bagianA');
	// 	var bagianB = $('.bagianB');

	// 	if(bagian == 'a') {
	// 		$('.bagianA').show();
	// 		$('#judulBagianA').html('-- Pilih Bagian A --');
	// 		$('.bagianB').hide();
	// 	} else if(bagian == 'b') {
	// 		$('.bagianB').show();
	// 		$('#judulBagianB').html('-- Pilih Bagian B --');
	// 		$('.bagianA').hide();
	// 	}
	// });

	// $(".tombolGerbong").click(function(){
 //        var url_string = "http://localhost/tiket-kereta-ci3/tamu/konfirmasi"; //window.location.href
 //        var url = new URL(url_string);
 //        var c = url.searchParams.get("kode");
 //        console.log(c);
 //    });



	


	// $('.tombolPilihGerbong').click(function() {
	// 	$('#exampleModalLabel').html('Pilih Gerbong');
	// 	$('.modal-footer button[type=submit]').html('Pilih');

	// });

	// $('.tombolUbahGerbong').click(function() {
	// 	$('#exampleModalLabel').html('Ubah Gerbong');
	// 	$('.modal-footer button[type=submit]').html('Ubah');
	// 	$('.modal-body form').attr('action', 'http://localhost/tiket-kereta-ci3/tamu/konfirmasi/ubahgerbong');

	// 	const id = $(this).data('id');
	// 	console.log(id);

	// 	$.ajax({
	// 		url: 'http://localhost/tiket-kereta-ci3/tamu/konfirmasi/getgerbong',
	// 		method: 'post',
	// 		dataType: 'json',
	// 		data: {id: id},
	// 		success: function(data) {
	// 			console.log(data);
	// 			$('#id_penumpang').val(data.id_penumpang);
	// 		}
	// 	})
	// });





});