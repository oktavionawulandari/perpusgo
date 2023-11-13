@extends('layouts.mainlayout')
@section('body')
@include('navigasi.nav-admin')
<div class="container mt-5">
<div class="my-3 py-5">
    <!--Informasi Masing-Masing Fitur -->
    <div class="row justify-content-center">
        <div class="container row">
        <!-- Info Transaksi -->
                <div class="col col-3">
                <div class="card border-5 row g-0" style="border-color: #757BC8">
                    <div class="card-header text-center " style="background-color: #757BC8">
                    <a href="{{route('transaksi.index')}}" class="text-light" style="text-decoration: none"><i class="bi bi-arrow-left-right me-1" style="font-size:1rem;"></i>Transaksi</a>
                    </div>
                    <div class="card-body">Transaksi Terlambat: {{$infotransaksi}}<br><br></div>
                </div>
                </div>
        <!-- Info Buku -->
                <div class="col col-3">
                <div class="card border-5 row g-0" style="border-color: #757BC8">
                    <div class="card-header text-center" style="background-color: #757BC8">
                        <a href="{{route('buku.index')}}" class="text-light" style="text-decoration: none"> <i class="bi bi-book-half me-1" style="font-size:1rem;"></i>Buku</a>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan Jumlah Buku yang Dipinjam dan Tersedia-->
                        Buku yang Dipinjam: {{$jmlbukudipinjam}}
                        <br>Buku yang Tersedia: {{$jmlbukutersedia}}
                    </div>
                </div>
                </div>
        <!-- Info Anggota -->
                <div class="col col-3">
                <div class="card border-5 row g-0" style="border-color: #757BC8">
                    <div class="card-header text-center" style="background-color: #757BC8">
                        <a href="{{route('anggota.index')}}" class="text-light" style="text-decoration: none"><i class="bi bi-people-fill me-1" style="font-size:1rem;"></i>Anggota</a>
                    </div>
                    <div class="card-body">Jumlah Keseluruhan: {{$totalanggota}}<br><br></div>
                </div>
                </div>

        <!-- Info Pegawai-->
                <div class="col col-3">
                <div class="card border-5 row g-0" style="border-color: #757BC8">
                    <div class="card-header text-center text-light" style="background-color: #757BC8">
                         <a href="{{route('pegawai.index')}}" class="text-light" style="text-decoration: none"><i class="bi bi-person-badge-fill me-1" style="font-size:1rem;"></i>Pegawai</a>
                    </div>
                    <div class="card-body">Jumlah Keseluruhan: {{$totalpegawai}}<br><br></div>
                </div>
                </div>
    </div>

    <!-- Chart Masing-Masing Fitur -->
    <!-- Chart Transaksi-->
        <div class="container row mt-5">
        <div class="col col-12">
        <div class="card border-5" style="border-color: #757BC8">
            <div class="card-body">
                <canvas id="bar-chartTransaksi"></canvas>
                <a href="{{route('transaksi.index')}}" class="float-end mt-2" style="color: #000000">
                    Telusuri Transaksi <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <!-- javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script>
        $(function() {
            //get the bar chart canvas
            var cData = JSON.parse(`<?php echo $chart_data3; ?>`);
            var ctx = $("#bar-chartTransaksi");

            //bar chart data
            var data = {
                labels: cData.label,
                datasets: [{
                    label: "Jumlah Transaksi",
                    data: cData.data,
                    backgroundColor: [
                        "#757BC8",
                        "#EF3E33",
                        "#1CC2AF",
                        "#FF8C42",
                        "#1CC2AF",
                        "#8E94F2",
                        "#FF708A",
                        "#757BC8",
                        "#EF3E33",
                        "#1CC2AF",
                        "#FF8C42",
                        "#1CC2AF",
                    ],
                    borderColor: [
                        "#757BC8",
                        "#EF3E33",
                        "#1CC2AF",
                        "#FF8C42",
                        "#1CC2AF",
                        "#8E94F2",
                        "#FF708A",
                        "#757BC8",
                        "#EF3E33",
                        "#1CC2AF",
                        "#FF8C42",
                        "#1CC2AF",
                    ],
                    borderWidth: [1, 1, 1, 1, 1, 1, 1,1,1,1,1,1]
                }]
            };

            //options
            var options = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Jumlah Transaksi Per Bulan",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
            };

            //create bar Chart class object
            var chart1 = new Chart(ctx, {
                type: "bar",
                data: data,
                options: options
            });

        });
        </script>
        </div>
        </div>

    <!-- Chart Buku-->
        <div class="container row mt-5">
        <div class="col col-12">
        <div class="card border-5" style="border-color: #757BC8">
            <div class="card-body">
                <canvas id="bar-chartBuku"></canvas>
                <a href="{{route('buku.index')}}" class="float-end mt-2" style="color: #000000">
                        Telusuri Buku <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <!-- javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script>
            $(function() {
                //get the bar chart canvas
                var cData = JSON.parse(`<?php echo $chart_data2; ?>`);
                var ctx = $("#bar-chartBuku");

                //bar chart data
                var data = {
                    labels: cData.label,
                    datasets: [{
                        label: "Jumlah Buku",
                        data: cData.data,
                        backgroundColor: [
                        "#757BC8",
                        "#EF3E33",
                        "#1CC2AF",
                        "#FF8C42",
                        "#1CC2AF",
                        "#8E94F2",
                        "#FF708A",
                        "#757BC8",
                        "#EF3E33",
                        "#1CC2AF",
                        ],
                        borderColor: [
                        "#757BC8",
                        "#EF3E33",
                        "#1CC2AF",
                        "#FF8C42",
                        "#1CC2AF",
                        "#8E94F2",
                        "#FF708A",
                        "#757BC8",
                        "#EF3E33",
                        "#1CC2AF",
                        ],
                        borderWidth: [1, 1, 1, 1, 1, 1,1,1,1,1]
                    }]
                };

                //options
                var options = {
                    responsive: true,
                    title: {
                        display: true,
                        position: "top",
                        text: "Jumlah Buku Per Kategori",
                        fontSize: 18,
                        fontColor: "#111"
                    },
                    legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
                };

                //create bar Chart class object
                var chart1 = new Chart(ctx, {
                    type: "bar",
                    data: data,
                    options: options
                });

            });
        </script>
        </div>
        </div>


    <!-- Chart Anggota-->
        <div class="container row mt-5">
        <div class="col col-12">
        <div class="card border-5" style="border-color: #757BC8">
            <div class="card-body">
                <canvas id="bar-chartAnggota"></canvas>
                <a href="{{route('anggota.index')}}" class="float-end mt-2" style="color: #000000">
                    Telusuri Anggota <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <!-- javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script>
        $(function() {
            //get the bar chart canvas
            var cData = JSON.parse(`<?php echo $chart_data1; ?>`);
            var ctx = $("#bar-chartAnggota");

            //bar chart data
            var data = {
                labels: cData.label,
                datasets: [{
                    label: "Jumlah Anggota",
                    data: cData.data,
                    backgroundColor: [
                    "#757BC8",
                    "#EF3E33",
                    "#1CC2AF",
                    "#FF8C42",
                    "#1CC2AF",
                    "#8E94F2",
                    ],
                    borderColor: [
                    "#757BC8",
                    "#EF3E33",
                    "#1CC2AF",
                    "#FF8C42",
                    "#1CC2AF",
                    "#8E94F2",
                    ],
                    borderWidth: [1, 1, 1, 1, 1, 1]
                }]
            };

            //options
            var options = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Jumlah Anggota Per Jurusan",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
            };

            //create bar Chart class object
            var chart1 = new Chart(ctx, {
                type: "bar",
                data: data,
                options: options
            });

        });
        </script>
        </div>
        </div>


    <!-- Chart Pegawai-->
        <div class="container row mt-5">
        <div class="col col-12">
        <div class="card border-5" style="border-color: #757BC8">
            <div class="card-body">
                <canvas id="pie-chartPegawai"></canvas>
                <a href="{{route('pegawai.index')}}" class="float-end mt-2" style="color: #000000">
                    Telusuri Pegawai <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <!-- javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script>
        $(function() {
            //get the pie chart canvas
            var cData = JSON.parse(`<?php echo $chart_data4; ?>`);
            var ctx = $("#pie-chartPegawai");

            //pie chart data
            var data = {
                labels: cData.label,
                datasets: [{
                    label: "Jumlah Transaksi",
                    data: cData.data,
                    backgroundColor: [
                        "#757BC8",
                        "#8E94F2",
                        
                    ],
                    borderColor: [
                    "#757BC8",
                    "#8E94F2",
                    ],
                    borderWidth: [1, 1]
                }]
            };

            //options
            var options = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Jumlah Pegawai Berdasarkan Jenis Kelamin",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
            };

            //create pie Chart class object
            var chart1 = new Chart(ctx, {
                type: "pie",
                data: data,
                options: options
            });

        });
        </script>
        </div>
        </div>


    </div>
</div>

</div>

@endsection