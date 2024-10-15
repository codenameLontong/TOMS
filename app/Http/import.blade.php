<!-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Import Pegawai</h1>
        <form action="{{ route('pegawai.import.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>
            <button type="submit">Upload</button>
        </form>
    </div>
@endsection -->
