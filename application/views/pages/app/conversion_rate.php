<?php $this->load->view("_partials/header")?>
    <div class="wrapper">
        <div class="sticky-top">
            <?php $this->load->view("_partials/navbar-header")?>
            <?php $this->load->view("_partials/navbar")?>
        </div>
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Conversion Rate
                            </h2>
                            
                            <form action="<?= base_url()?>app/change_tgl" method="post">
                                <div class="row row-cols-auto mt-3">
                                    <div class="col">
                                        <input type="date" name="tgl_awal" class="form form-control" value="<?= $setting_cs['tgl_awal']?>">
                                    </div>
                                    <div class="col">
                                        <input type="date" name="tgl_akhir" class="form form-control" value="<?= $setting_cs['tgl_akhir']?>">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-md btn-success">Go</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            
                            <div style="height:50vh;">
                                <canvas id="myChart"></canvas>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>

    <!-- load modal -->
    <?php 
        if(isset($modal)) :
            foreach ($modal as $i => $modal) {
                $this->load->view("_partials/modal/".$modal);
            }
        endif;
    ?>

    <script>
        $("#<?= $menu?>").addClass("active")
    </script>

    <!-- load javascript -->
    <?php  
        if(isset($js)) :
            foreach ($js as $i => $js) :?>
                <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
                <?php 
            endforeach;
        endif;    
    ?> 
 
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.js"></script>

	<script>
		const ctx = document.getElementById('myChart').getContext('2d');
        const skipped = (ctx, value) => ctx.p0.skip || ctx.p1.skip ? value : undefined;
        const down = (ctx, value) => ctx.p0.parsed.y > ctx.p1.parsed.y ? value : undefined;

        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= $labels?>,
                datasets: [{
                    label: '# Closing',
                    data: <?= $data?>,
                    backgroundColor: <?= $warna?>,
                    borderColor: <?= $warna?>,
                    segment: {
                        borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)') || down(ctx, 'rgb(192,75,75)'),
                        borderDash: ctx => skipped(ctx, [6, 6]),
                    },
                    borderWidth: 1,
                    tension: 0.55
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                // responsive: true,
                maintainAspectRatio: false
            }
        });
	</script>


    
<?php $this->load->view("_partials/footer")?>