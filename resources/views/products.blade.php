<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Produk - Manajemen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS-->
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-5xl p-6">
        <div class="bg-white shadow-lg rounded-xl p-6">

            <!-- Judul -->
            <h2 class="text-2xl font-bold mb-4 text-center">Manajemen Produk</h2>

            <!-- Tabel Produk -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto border border-gray-200 rounded-lg text-sm text-left">
                    <thead class="bg-gray-200 font-semibold text-gray-700 ">
                        <tr>
                            <th class="p-3 border text-center">#</th>
                            <th class="p-3 border text-center">Kode</th>
                            <th class="p-3 border text-center">Nama</th>
                            <th class="p-3 border text-center">Harga</th>
                            <th class="p-3 border text-center">Stok</th>
                            <th class="p-3 border text-center">✔️</th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body">
                        {{-- Data akan dimuat di sini dengan JavaScript --}}
                    </tbody>
                </table>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-wrap gap-4 justify-center mt-6">
                <button id="load-btn"
                    class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-900 cursor-pointer">Load</button>
                <button id="insert-btn"
                    class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-900 cursor-pointer">Insert</button>
                <button id="update-btn"
                    class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-900 cursor-pointer">Update</button>
                <button id="delete-btn"
                    class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-900 cursor-pointer">Delete</button>
            </div>

        </div>
    </div>

    <!-- Modal Insert -->
    <div id="product-modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <h3 class="text-xl font-bold mb-4">Tambah Produk</h3>

            <form id="product-form">
                <div class="mb-3">
                    <label for="nama" class="block text-sm font-medium">Nama Produk</label>
                    <input type="text" id="nama" name="nama" class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="mb-3">
                    <label for="harga" class="block text-sm font-medium">Harga</label>
                    <input type="number" id="harga" name="harga" class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="mb-3">
                    <label for="stock" class="block text-sm font-medium">Stok</label>
                    <input type="number" id="stock" name="stock" class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" id="close-modal"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
                        id="modal-submit-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#load-btn').on('click', function() {
            $.get(`/product/fetch`, function(data) {

                let rows = '';
                let count = 1
                data.forEach(function(item) {
                    rows += `
                        <tr>
                            <td class="p-2 border text-center"> ${count} </td>
                            <td class="p-2 border text-center">itm-${item.kode}</td>
                            <td class="p-2 border">${item.nama}</td>
                            <td class="p-2 border">Rp ${item.harga.toLocaleString('id-ID')}</td>
                            <td class="p-2 border text-center">${item.stock}</td>
                            <td class="p-2 border text-center">
                                <input type="radio" id="${item.kode}" name="product">
                            </td>
                        </tr>
                    `;
                count++
                });
                $('#product-table-body').html(rows);
                // membuat warna row berubah ketika dipiplih
                $('input[name="product"]').on('change', function() {
                    $('#product-table-body tr').removeClass('bg-yellow-400');
                    $(this).closest('tr').addClass('bg-yellow-400');
                });
            }).fail(function() {
                alert('Gagal memuat data.');
            });
        });
    </script>

    <script>
        function resetProductForm() {
            $('#nama').val('');
            $('#harga').val('');
            $('#stock').val('');
        }

        // Buka modal untuk insert
        $('#insert-btn').on('click', function() {
            resetProductForm();
            $('#modal-title').text('Tambah Produk');
            $('#modal-submit-btn').text('Simpan');
            $('#product-modal').removeClass('hidden');
            $('#product-form').data('mode', 'insert');
        });

        // Buka modal untuk update
        $('#update-btn').on('click', function() {
            const selected = $('input[name="product"]:checked');
            if (!selected.length) return alert('Pilih produk terlebih dahulu.');
            const kode = selected.attr('id');
            $.get(`/product/${kode}/show`, function(data) {
                $('#nama').val(data.nama);
                $('#harga').val(data.harga);
                $('#stock').val(data.stock);

                $('#modal-title').text('Update Produk');
                $('#modal-submit-btn').text('Update');
                $('#product-modal').removeClass('hidden');
                $('#product-form').data('mode', 'update');
            });
        });

        // Tutup modal
        $('#close-modal').on('click', function() {
            $('#product-modal').addClass('hidden');
        });

        // (Opsional) Tangani form submit di sini
        $('#product-form').on('submit', function(e) {
            e.preventDefault();
            const mode = $(this).data('mode');
            const data = {
                nama: $('#nama').val(),
                harga: $('#harga').val(),
                stock: $('#stock').val(),
                _token: '{{ csrf_token() }}'
            };

            if (mode === 'insert') {
                $.post(`/product/store`, data, function(response) {
                    alert('Produk berhasil ditambahkan!');
                    $('#product-modal').addClass('hidden');
                    $('#load-btn').click(); // reload tabel
                }).fail(function() {
                    alert('Gagal menyimpan data.');
                });
            } else {
                const selected = $('input[name="product"]:checked');

                const kode = selected.attr("id")
                data._method = 'PUT';
                data._kode = kode;

                $.post(`/product/${kode}/update`, data, function(response) {
                    alert('Produk berhasil dirubah!');
                    $('#product-modal').addClass('hidden');
                    $('#load-btn').click(); // reload tabel
                }).fail(function() {
                    alert('Gagal update data.');
                });
            }

        });

        $('#delete-btn').on('click', function() {
            const selected = $('input[name="product"]:checked');

            if (!selected.length) {
                alert('Silakan pilih produk yang ingin dihapus.');
                return;
            }
            const kode = selected.attr('id');

            if (confirm('Yakin ingin menghapus produk ini?')) {
                $.post(`/product/${kode}/delete`, {
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
                    })
                    .done(function() {
                        alert('Produk berhasil dihapus!');
                        $('#load-btn').click(); // reload data tabel
                    })
                    .fail(function() {
                        alert('Gagal menghapus produk.');
                    });
            };

        });
    </script>

</body>


</html>