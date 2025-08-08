

@extends('adminlte::page')

@section('title', 'Clients Management')

@section('content_header')
@stop


@section('content')

<div class="client-detail-form mb-5">
    <h2>Detail Client</h2>

    <div class="client-header">
        <div class="client-photo">
            <img src="{{ asset('img/user.png') }}" alt="Client Photo" id="client-photo-preview">
            {{-- <input type="file" id="client-photo-upload" accept="image/*">
            <button class="btn-upload">Upload Foto</button> --}}
        </div>


{{-- @foreach ($data_client as $item ) --}}


        <div class="client-basic-info">
            <div class="form-group">
                <label for="client-name">Nama:</label>
                <input type="text" id="client-name" value="{{ $data_client->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="client-email">Email:</label>
                <input type="email" id="client-email" value="{{$data_client->email }}" readonly>
            </div>

            <div class="form-group">
                <label for="client-phone">Telepon:</label>
                <input type="text" id="client-phone" value="{{ $data_client->phone }}" readonly>
            </div>
        </div>
    </div>



    <div class="form-actions">
        <a href="/admin/clients/{{ $data_client->id }}/edit" class="btn-edit">Edit Data</a>
        <a href="/admin/clients" class="btn-back">Kembali </a>
    </div>
</div>

</div>
{{-- @endforeach --}}
@stop


<style>
.client-detail-form {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.client-header {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.client-photo {
    width: 150px;
    text-align: center;
}

.client-photo img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #eee;
    margin-bottom: 10px;
}

.client-basic-info, .client-additional-info {
    flex: 1;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-group textarea {
    min-height: 80px;
}

.form-actions {
    margin-top: 20px;
    text-align: right;
}

.btn-edit, .btn-save, .btn-cancel, .btn-back, .btn-upload {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 10px;
}

.btn-edit, .btn-save {
    background-color: #4CAF50;
    color: white;
}

.btn-cancel {
    background-color: #f44336;
    color: white;
}

.btn-back {
    background-color: #2196F3;
    color: white;
}

.btn-upload {
    background-color: #FF9800;
    color: white;
    display: block;
    width: 100%;
    margin-top: 5px;
}

input[readonly], textarea[readonly] {
    background-color: #f5f5f5;
}
</style>

