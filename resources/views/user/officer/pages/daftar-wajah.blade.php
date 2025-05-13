<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pendaftaran Wajah Mahasiswa</title>
    <style>
        body{font-family:sans-serif;background:#f3f3f3;display:flex;justify-content:center;padding:30px}
        .box{background:#fff;padding:25px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.1);width:420px}
        select,input,button{width:100%;margin:10px 0;padding:8px;border-radius:5px;border:1px solid #ccc}
        .alert{padding:10px;border-radius:5px;margin-bottom:15px}
        .success{background:#d4edda;color:#155724}.error{background:#f8d7da;color:#721c24}
    </style>
</head>
<body>
<div class="box">
    <h3>Daftarkan Wajah Mahasiswa</h3>

    @if(session('success'))<div class="alert success">{{session('success')}}</div>@endif
    @if(session('error'))  <div class="alert error">{{session('error')}}</div>@endif

    <form action="{{route('officer.absen-wajah')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Pilih Mahasiswa</label>
        <select name="mahasiswas_id" required>
            <option value="">-- pilih --</option>
            @foreach($mahasiswas as $mhs)
                <option value="{{$mhs->id}}">{{$mhs->mhs_name}} | {{$mhs->mhs_nim}}</option>
            @endforeach
        </select>

        <label>Foto Wajah</label>
        <input type="file" name="foto" accept="image/*" required>

        <button type="submit">Simpan Face Token</button>
    </form>
</div>
</body>
</html>
