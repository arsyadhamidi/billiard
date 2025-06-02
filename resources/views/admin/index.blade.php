<!-- Small boxes (Stat box) -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $countMeja ?? '0' }}</h3>

                <p>Data Meja</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $countPaket ?? '0' }}</h3>

                <p>Data Paket</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $countUser ?? '0' }}</h3>

                <p>User Registrasi</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $countBooking ?? '0' }}</h3>

                <p>Data Pemesanan</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row (main row) -->


<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Jumlah Pemesanan Per Bulan {{ \Carbon\Carbon::now()->translatedFormat('F') }}
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="cutiChart" class="w-100" style="height: 600px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


@push('custom-script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('cutiChart').getContext('2d');
            const pesananData = @json($pesananData); // ⬅️ sama dengan yang dikirim controller
            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: 'Jumlah Booking per Bulan',
                        data: pesananData,
                        backgroundColor: 'rgba(75,192,192,0.2)',
                        borderColor: 'rgba(75,192,192,1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
