@vite(['resources/scss/app.scss', 'resources/js/app.js'])

<div class="card">
    <div class="d-flex justify-content-center">
        <a href="{{ route('logout') }}" class="btn btn-primary">Keluar</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                @foreach (array_keys($users->first()->toArray()) as $key)
                    <th>{{ $key }}</th>      
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    @foreach ($item->toArray() as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                    <td>
                        <a href="{{ route('edit-app', $item['id']) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>