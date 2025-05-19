LOAD DATA INFILE 'PRINTER.csv'
INTO TABLE produk
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(kategori_id, toko_id, kode_produk, nama_produk, harga_produk, stok_produk, deskripsi_produk, merk_produk, image)
SET produk_id = NULL;
