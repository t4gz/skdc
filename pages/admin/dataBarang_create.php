<?php
include '../../connector/koneksi.php';

// Query to get categories
$query = "SELECT kategori_id, nama_kategori FROM kategori";
$result = mysqli_query($kon, $query);

$query2 = "SELECT toko_id, lokasi FROM toko";
$result2 = mysqli_query($kon, $query2);
?>

<h4 class="mb-4">Tambah Barang</h4>
<form method="POST" action="dataBarang_create_proses.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk</label>
        <input type="text" id="nama" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="kode" class="form-label">Kode Produk</label>
        <input type="text" id="kode" name="kode" class="form-control" required>
    </div>
    <div class="mb-3" style="position: relative;">
        <label for="merk_produk" class="form-label">Tipe Produk</label>
        <div style="display: flex; align-items: center; gap: 8px;">
            <input type="text" id="merk_produk" name="merk_produk" class="form-control" required style="flex-grow: 1;">
            <div>
                <button type="button" class="btn btn-sm category-btn my-1 mx-1" style="background-color: black; color: orange;" data-category="aksesori">Aksesoris</button>
                <button type="button" class="btn btn-sm category-btn my-1 mx-1" style="background-color: black; color: orange;" data-category="konektor">Konektor</button>
                <button type="button" class="btn btn-sm category-btn my-1 mx-1" style="background-color: black; color: orange;" data-category="komputer">Komputer</button>
                <button type="button" class="btn btn-sm category-btn my-1 mx-1" style="background-color: black; color: orange;" data-category="laptop">Laptop</button>
                <button type="button" class="btn btn-sm category-btn my-1 mx-1" style="background-color: black; color: orange;" data-category="printer">Printer</button>
            </div>
        </div>
        <div id="category-card" class="card" style="position: absolute; top: 100%; left: 0; z-index: 1000; width: 100%; max-width: 400px; display: none; max-height: 300px; overflow-y: auto;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span id="category-card-title"></span>
                <button type="button" id="category-card-close" class="btn-close" aria-label="Close"></button>
            </div>
            <ul class="list-group list-group-flush" id="category-card-list" style="cursor: pointer;">
            </ul>
        </div>
    </div>
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select id="kategori_id" name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['nama_kategori']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="toko_id" class="form-label">toko</label>
        <select id="toko_id" name="toko_id" class="form-control" required>
            <option value="">-- Pilih Toko --</option>
            <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
                <option value="<?php echo $row['toko_id']; ?>"><?php echo $row['lokasi']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" id="harga" name="harga" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" id="stok" name="stok" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" id="gambar" name="gambar" class="form-control-file" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>

<script>
    const categoryData = {
        aksesori: {
            title: "Aksesoris Tipe",
            items: [
                "atk", "casing", "flashdisk", "hdd", "headset", "keyboard", "mouse", "software", "speaker", "ssd", "tas", "wifi"
            ]
        },
        konektor: {
            title: "Konektor Tipe",
            items: [
                "kabelcharger", "kabelconverter", "kabeldisplay", "kabeljaringan", "kabelusb"
            ]
        },
        komputer: {
            title: "Komputer Tipe",
            items: [
                "aio", "monitor", "rakitan"
            ]
        },
        laptop: {
            title: "Tipe Laptop",
            items: [
                "acer", "advan", "asus", "axioo", "dell", "hp", "lenovo"
            ]
        },
        printer: {
            title: "Tipe Printer",
            items: [
                "canon", "cartridge", "tinta", "epson"
            ]
        }
    };

    const merkInput = document.getElementById('merk_produk');
    const card = document.getElementById('category-card');
    const cardTitle = document.getElementById('category-card-title');
    const cardList = document.getElementById('category-card-list');
    const cardClose = document.getElementById('category-card-close');
    const buttons = document.querySelectorAll('.category-btn');

    function showCard(categoryKey) {
        const data = categoryData[categoryKey];
        if (!data) return;
        cardTitle.textContent = data.title;
        cardList.innerHTML = '';
        data.items.forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.textContent = item;
            li.addEventListener('click', () => {
                // Replace the merk_produk input value with the selected item (only one type allowed)
                merkInput.value = item;
                hideCard();
            });
            cardList.appendChild(li);
        });
        card.style.display = 'block';
    }

    function hideCard() {
        card.style.display = 'none';
    }

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const category = button.getAttribute('data-category');
            showCard(category);
        });
    });

    cardClose.addEventListener('click', hideCard);

    // Hide card when clicking outside
    document.addEventListener('click', (event) => {
        if (!card.contains(event.target) && !Array.from(buttons).some(btn => btn.contains(event.target))) {
            hideCard();
        }
    });
</script>
