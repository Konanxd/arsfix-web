<h1>Data Customers</h1>
<a href="{{ route('customers.create') }}">Tambah Customer</a>
@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No. Telp</th>
            <th>Handphone</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $c)
        <tr>
            <td>{{ $c->customers_id }}</td>
            <td>{{ $c->name_customers }}</td>
            <td>{{ $c->phone_number }}</td>
            <td>{{ $c->handphone }}</td>
            <td>
                <a href="{{ route('customers.edit', $c->customers_id) }}">Edit</a>
                <form action="{{ route('customers.destroy', $c->customers_id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
