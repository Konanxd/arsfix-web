<h2>Tambah Customer</h2>
<form method="POST" action="{{ route('customers.store') }}">
    @csrf
    ID: <input type="text" name="customers_id" required><br>
    Nama: <input type="text" name="name_customers" required><br>
    No. Telp: <input type="text" name="phone_number"><br>
    Handphone: <input type="text" name="handphone"><br>
    <button type="submit">Simpan</button>
</form>
<a href="{{ route('customers.index') }}">Kembali</a>
