@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop




@section('content')

 <div class="dashboard container-fluid mt-2">
        <div class="alert bg-white text-primary shadow-sm">Hallo <span>{{ auth()->user()->name}}</span> Selamat Datang Di Halaman Dashboard User</div>

<div class="container-fluid">
  <div class="row">
    <!-- Card 1 -->
    <div class="col-md-4">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title " style="font-size: 40px;">{{ $data_total['total_client'] }}</h5>
          <p class="card-text"> Total Data Clients</p>
        </div>
        <div class="card-footer text-center" >
            {{-- agar menuju ke halaman clintes --}}
            <a href="/admin/clients" class="text-white  " style="   text-decoration: none">More info     <i class="bi bi-arrow-right-circle-fill"></i></a>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-4">
      <div class="card text-white bg-primary mb-3" >
        <div class="card-body" style="background: red;  border: 2px solid red">
          <h5 class="card-title " style="font-size: 40px;">{{ $data_total['total_invoice'] }}</h5>
          <p class="card-text"> Total Data Invoice</p>
        </div>
        <div class="card-footer text-center"  style="background: red;" >
            <a href="/admin/invoices" class="text-white  " style="   text-decoration: none">More info     <i class="bi bi-arrow-right-circle-fill"></i></a>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-4">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body" style="background: green">
          <h5 class="card-title " style="font-size: 40px;">{{ $data_total['total_user'] }}</h5>
          <p class="card-text"> Total Data User</p>
        </div>
        <div class="card-footer text-center" style="background: green">
            <a href="/admin/user" class="text-white  " style="   text-decoration: none"> More info     <i class="bi bi-arrow-right-circle-fill"></i></a>
        </div>
      </div>
    </div>
  </div>


{{-- donat --}}
{{-- dari w3scholl

link:https://www.w3schools.com/ai/ai_chartjs.asp


1.tambahkan:<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

2.<canvas id="myChart" style="width:100%;max-width:700px"></canvas>
(kalau lebih dari 2 id jgn sama)
--}}

<div class="row border mt-3">
    {{-- 1 --}}
<div class="col-lg-6">
    <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
<script>
var xValues = ["Clintes", "User", "Invoice", "Produk", ""];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
//   "#00aba9",
//   "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart1", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Statistik Perusahaan"
    }
  }
});
</script>
</div>

{{-- 2 id nya diganti supaya tidak bentrok --}}
<div class="col-lg-6">
    <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>
<script>
var xValues = ["Clintes", "User", "Invoice", "Produk", ""];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];



new Chart("myChart2", {
    // bisa diganti agar bentuk berbeda
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Statistik Perusahaan"
    }
  }
});
</script>
</div>

  </div>
</div>






@stop






{{-- link bootrpas --}}
@section('css')





{{-- animasi donat --}}
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
{{-- linl icon bootraps --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@stop





@section('js')




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop


