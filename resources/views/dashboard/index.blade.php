@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    {{-- <h3>Hello Word</h3> --}}
    <div class="card  mb-4">
        <h6 class="text-center mt-2">REKAPITULASI PEGAWAI BERDASARKAN JENIS KELAMIN</h6>
        <div class="chart-container">
        <canvas id="jenis_kelamin"></canvas>
      </div>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
      <script>
        $(document).ready(function() {
        $.ajax({
            url: "/app/Http/Controllers/MagangController.php", // Ganti dengan URL yang sesuai untuk mengambil data dari database
            type: "GET",
            dataType: "json",
            success: function(response) {
                var select = $('#jenis_kelamin');

                $.each(response, function(key, value) {
                    var option = $('<option></option>')
                        .attr('value', value)
                        .text(value);

                    select.append(option);
                });

                // Set opsi yang dipilih berdasarkan data dari database
                var selectedValue = "Laki-Laki"; // Ganti dengan nilai yang sesuai dari data database
                select.val(selectedValue);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
        
        const ctx = document.getElementById('jenis_kelamin');

        
        new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ['Laki-Laki = 129', 'Perempuan 36'],
            datasets: [{
              label: '# of Votes',
              data: [15, 5],
              backgroundColor: ['#36A2EB', '#FF6384'],
              hoverBackgroundColor: ['#36A2EB', '#FF6384'],
              hoverBorderColor: 'rgba(220,220,220,1)',
              
            }],
            hoverOffset: 4
          },
          options: {
                responsive: true,
                maintainAspectRatio: false,
          }
        });
      </script>
      <div class="card">
        <h6 class="text-center mt-2">REKAPITULASI PEGAWAI BERDASARKAN GRADE</h6>
        <div class="chart-container">
        <canvas id="jenjang_pendidikan"></canvas>
      </div>
    </div>
      <script>
       

        const jenjang_pendidikan = document.getElementById('jenjang_pendidikan');
        new Chart(jenjang_pendidikan, {
          type: 'doughnut',
          data: {
            labels: ['SMP','SMA','SMK','D3','S1','S2'],
            datasets: [{
              label: '%',
              data: [1, 5, 7, 10, 2, 4],
              backgroundColor: ['black','orange','#4CAF50','red','blue','green'],

            }],
            hoverOffset: 4
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            borderWidth:1,
            xpadding: 15,
            ypadding: 15,
            
            }
        });
      </script>
    {{-- document.addEventListener('DOMContentLoaded', function () {
        // Grafik Jenis Kelamin
        var genderChart = new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: ['Laki-Laki', 'Perempuan'],
                datasets: [{
                    data: [{ $laki_laki }, { $perempuan }],
                    backgroundColor: ['#36A2EB', '#FF6384']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        // Grafik Jenjang Pendidikan
        var educationLevelChart = new Chart(document.getElementById('educationLevelChart'), {
            type: 'bar',
            data: {
                labels: ['SMK', 'D3', 'S1'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{ $smkCount }, { $d3Count }, { $s1Count }],
                    backgroundColor: '#4CAF50'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    }); --}}

  
       
    @endsection
