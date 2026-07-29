$(document).ready(function () {
	// 1. Inisialisasi DataTables dengan batas 10 data per halaman
	$("#tabel-barang").DataTable({
		pageLength: 10,
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "Semua"],
		],
		language: {
			lengthMenu: "Tampilkan _MENU_ data per halaman",
			zeroRecords: "Data tidak ditemukan",
			info: "Menampilkan halaman _PAGE_ dari _PAGES_",
			infoEmpty: "Tidak ada data tersedia",
			infoFiltered: "(disaring dari _MAX_ total data)",
			search: "Cari:",
			paginate: {
				first: "Pertama",
				last: "Terakhir",
				next: "Selanjutnya",
				previous: "Sebelumnya",
			},
		},
	});

	// 2. Mengisi data ke Modal Edit (Event Delegation agar aktif di page 2, 3, dst.)
	$(document).on("click", ".btn-edit", function () {
		const id = $(this).data("id");
		const kode = $(this).data("kode");
		const nama = $(this).data("nama");
		const kategori = $(this).data("kategori");
		const stok = $(this).data("stok");
		const harga = $(this).data("harga");

		$("#edit_id").val(id);
		$("#edit_kode").val(kode);
		$("#edit_nama").val(nama);
		$("#edit_kategori").val(kategori);
		$("#edit_stok").val(stok);
		$("#edit_harga").val(harga);
	});

	// 3. Alert otomatis hilang setelah 3 detik
	setTimeout(function () {
		$(".alert").fadeOut("slow", function () {
			$(this).remove();
		});
	}, 3000);
});
