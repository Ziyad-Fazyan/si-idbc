<!DOCTYPE html>
<html>
<head>
    <title>Absensi Wajah</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            padding: 30px;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
        }
        input[type="file"] {
            margin: 15px 0;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .success { background: #d4edda; color: #155724; }
        .error   { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div class="container">
    <h2>Absensi Wajah</h2>

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('officer.absen-wajah-cek') }}" enctype="multipart/form-data">
        @csrf
        <label for="foto">Upload Foto Wajah:</label>
        <input type="file" name="foto" accept="image/*" required>
        <br>
        <button type="submit">Absen Sekarang</button>
    </form>
</div>
</body>
</html>