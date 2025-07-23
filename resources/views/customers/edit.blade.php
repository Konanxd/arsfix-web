<h2>Edit Customer</h2>
<form method="POST" action="{{ route('customers.update', $customer->customers_id) }}">
    @csrf
    @method('PUT')
    Nama: <input type="text" name="name_customers" value="{{ $customer->name_customers }}" required><br>
    No. Telp: <input type="text" name="phone_number" value="{{ $customer->phone_number }}"><br>
    Handphone: <input type="text" name="handphone" value="{{ $customer->handphone }}"><br>
    <button type="submit">Update</button>
</form>
<a href="{{ route('customers.index') }}">Kembali</a>
