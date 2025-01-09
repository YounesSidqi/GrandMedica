@extends('layout.app')
@include('layout.nav_admin')

@section('main')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-6">Pemasukan dan Pengeluaran</h2>
    
    <!-- Chart Mingguan -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-3">Data Mingguan</h3>
        <p class="text-sm text-gray-500 mb-4">* Pilih bulan dan minggu untuk melihat data</p>
        
        <!-- Dropdown Bulan -->
        <select id="month-dropdown" class="mb-4 p-2 border rounded">
            <option value="">Pilih Bulan</option>
            @foreach ($weeklyData->groupBy('month')->keys() as $month)
                <option value="{{ $month }}">{{ \Carbon\Carbon::parse($month)->format('F Y') }}</option>
            @endforeach
        </select>

        <!-- Dropdown Minggu -->
        <select id="week-dropdown" class="mb-4 p-2 border rounded" disabled>
            <option value="">Pilih Minggu</option>
        </select>

        
        <!-- Container Chart Mingguan -->
        <div id="weekly-chart-container" class="w-full"></div>
    </div>

    <!-- Chart Bulanan -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-3">Data Bulanan</h3>
        <p class="text-sm text-gray-500 mb-4">* Grafik untuk setiap bulan</p>
        <div id="monthly-chart" class="w-full"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    const weeklyData = @json($weeklyData);
    const monthlyData = @json($monthlyData);

    let currentWeeklyChart = null;

    // Fungsi untuk mengisi dropdown minggu berdasarkan bulan
    document.getElementById('month-dropdown').addEventListener('change', function(event) {
        const selectedMonth = event.target.value;
        const weekDropdown = document.getElementById('week-dropdown');

        // Kosongkan dropdown minggu
        weekDropdown.innerHTML = '<option value="">Pilih Minggu</option>';
        weekDropdown.disabled = true;

        // Hapus chart yang sedang aktif
        if (currentWeeklyChart) {
            currentWeeklyChart.destroy();
            currentWeeklyChart = null;
        }

        if (selectedMonth) {
            // Filter data berdasarkan bulan yang dipilih
            const filteredWeeks = weeklyData.filter(item => item.month === selectedMonth);

            // Aktifkan dropdown minggu
            weekDropdown.disabled = false;

            // Tambahkan opsi minggu pertama hingga terakhir
            filteredWeeks.forEach((week, index) => {
                const option = document.createElement('option');
                option.value = index; // Index untuk memetakan minggu
                option.textContent = `Minggu ke-${index + 1}`;
                weekDropdown.appendChild(option);
            });
        }
    });

    // Fungsi untuk memperbarui chart mingguan berdasarkan minggu
    document.getElementById('week-dropdown').addEventListener('change', function(event) {
        const selectedMonth = document.getElementById('month-dropdown').value;
        const selectedWeekIndex = event.target.value;

        // Hapus chart sebelumnya
        if (currentWeeklyChart) {
            currentWeeklyChart.destroy();
            currentWeeklyChart = null;
        }

        if (selectedMonth && selectedWeekIndex) {
            const filteredWeeks = weeklyData.filter(item => item.month === selectedMonth);

            // Tentukan data untuk minggu yang dipilih
            const selectedWeekData = filteredWeeks[selectedWeekIndex];

            // Chart data untuk 7 hari
            const weeklyOptions = {
                chart: {
                    type: 'bar',
                    height: 400,
                    toolbar: { show: false },
                },
                series: [
                    {
                        name: 'Pemasukan',
                        data: selectedWeekData.data.map(item => item.total_in),
                    },
                    {
                        name: 'Pengeluaran',
                        data: selectedWeekData.data.map(item => item.total_out),
                    },
                ],
                xaxis: {
                    categories: selectedWeekData.data.map(item => item.date),
                    title: {
                        text: 'Tanggal',
                        style: { fontSize: '14px', color: '#333' },
                    },
                },
                tooltip: {
                    x: {
                        formatter: function(value) {
                            return value;  // Tooltip menampilkan tanggal
                        }
                    }
                }
            };

            // Render chart baru
            const chartContainer = document.getElementById('weekly-chart-container');
            currentWeeklyChart = new ApexCharts(chartContainer, weeklyOptions);
            currentWeeklyChart.render();
        }
    });

    // Chart Data Bulanan
    const monthlyOptions = {
        chart: {
            type: 'bar',
            height: 400,
            toolbar: { show: false },
        },
        series: [
            {
                name: 'Pemasukan',
                data: monthlyData.map(item => item.total_in),
            },
            {
                name: 'Pengeluaran',
                data: monthlyData.map(item => item.total_out),
            },
        ],
        xaxis: {
            categories: monthlyData.map(item => item.month),
            title: {
                text: 'Bulan',
                style: { fontSize: '14px', color: '#333' },
            },
        },
        tooltip: {
            x: {
                formatter: function(value, index) {
                    return monthlyData[index.dataPointIndex].month; // Menampilkan nama bulan di tooltip
                }
            }
        }
    };

    // Render chart bulanan
    const monthlyChartContainer = document.getElementById('monthly-chart');
    const monthlyChart = new ApexCharts(monthlyChartContainer, monthlyOptions);
    monthlyChart.render();
</script>



@endsection
