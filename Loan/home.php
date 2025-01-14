<?php include 'db_connect.php' ?>
<style>

</style>

<div class="containe-fluid">

    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>

    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card" style="background-color: gray">
                <div class="card-body">
                    <h1>Bonus Emlak Gayrimenkul</h1>
                </div>
                <hr>
                <div class="row ml-2 mr-2">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Bugünkü ödemeler</div>
                                        <div class="text-lg font-weight-bold">
                                            <?php 
                                        	$payments = $conn->query("SELECT sum(amount) as total FROM payments where date(date_created) = '".date("Y-m-d")."'");
                                        	echo $payments->num_rows > 0 ? number_format($payments->fetch_array()['total'],2) : "0.00";
                                        	 ?>

                                        </div>
                                    </div>
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="index.php?page=payments">Ödemeler Sayfasına Git</a>
                                <div class="small text-white">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Kiracılar</div>
                                        <div class="text-lg font-weight-bold">
                                            <?php 
                                        	$borrowers = $conn->query("SELECT * FROM borrowers");
                                        	echo $borrowers->num_rows > 0 ? $borrowers->num_rows : "0";
                                        	 ?>

                                        </div>
                                    </div>
                                    <i class="fa fa-user-friends"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="index.php?page=borrowers">Kiracıları Görüntüle</a>
                                <div class="small text-white">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-warning text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Sözleşme Sayısı</div>
                                        <div class="text-lg font-weight-bold">
                                            <?php 
                                        	$loans = $conn->query("SELECT * FROM loan_list where status = 2");
                                        	echo $loans->num_rows > 0 ? $loans->num_rows : "0";
                                        	 ?>

                                        </div>
                                    </div>
                                    <i class="fa fa-user-friends"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="index.php?page=loans">Sözleşmeleri Görüntüle</a>
                                <div class="small text-white">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Toplam Gelirler</div>
                                        <div class="text-lg font-weight-bold">
                                            <?php 
                                        	$payments = $conn->query(query: "SELECT sum(amount - penalty_amount) as total FROM payments where date(date_created) = '".date("Y-m-d")."'");
                                        	$loans = $conn->query("SELECT sum(l.amount + (l.amount * (p.interest_percentage/100))) as total FROM loan_list l inner join loan_plan p on p.id = l.plan_id where l.status = 2");
                                        	$loans =  $loans->num_rows > 0 ? $loans->fetch_array()['total'] : "0";
                                        	$payments =  $payments->num_rows > 0 ? $payments->fetch_array()['total'] : "0";
                                        	echo number_format($loans - $payments,2);
                                        	 ?>

                                        </div>
                                    </div>
                                    <i class="fa fa-user-friends"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="index.php?page=loans">Sözleşme Detayları</a>
                                <div class="small text-white">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        </div>
    </div>

    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card" style="background-color: gray">
                <div class="card-body">
                    <h1>Grafikler</h1>
                    <?php 
                    $top5ödeme = $conn->query("SELECT amount FROM loan_list ORDER BY amount DESC LIMIT 5");
                    $evtipidağılımı = $conn->query("SELECT loan_type_id, COUNT(loan_type_id) as count FROM loan_list GROUP BY loan_type_id");
                    $data = [];
                    $dataev = [];
                    $total = 0;

                    while ($row = $evtipidağılımı->fetch_assoc()) {
                        $total += $row['count'];
                        $dataev[] = $row;
                    }

                    while ($row = $top5ödeme->fetch_assoc()) {
                        $data[] = $row['amount'];
                    }

                    $pctData = [];
                    foreach ($dataev as $row) {
                        $pctData[] = [
                            "plan_id" => "Ev Tipi " . $row['loan_type_id'], // Plan ID etiketi
                            "percentage" => round(($row['count'] / $total) * 100, 2) // Yüzde değeri
                        ];
                    }
                    ?>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);
                        google.charts.setOnLoadCallback(drawColumnChart);

                        function drawChart() {
        
                            var phpData1 = <?php echo json_encode($pctData); ?>;

                            var chartData = new google.visualization.DataTable();
                            chartData.addColumn("string", "Loan ID");
                            chartData.addColumn("number", "Percentage");

                         
                            phpData1.forEach(row => {
                            chartData.addRow([row.plan_id, row.percentage]);
                            });

                           
                            var options = {
                            title: "Ev tipi dağılımı (Yüzdesel)",
                            pieHole: 0.4, 
                            is3D: true, 
                            legend: { position: "right" }
                            };

                            // Grafiği çiz
                            var chart = new google.visualization.PieChart(document.getElementById("piechart"));
                            chart.draw(chartData, options);
                        }
                        

                        function drawColumnChart() {
                            var phpData = <?php echo json_encode($data); ?>;
                            var chartData = new google.visualization.DataTable();
                            chartData.addColumn("string", "Loan");
                            chartData.addColumn("number", "Amount");

                            phpData.forEach((amount, index) => {
                                chartData.addRow([`${index + 1}`, parseFloat(amount)]);
                            });

                            var options = {
                                title: "En Yüksek 5 Kira Miktarı (Yıllık)",
                                width: 600,
                                height: 500,
                                bar: { groupWidth: "95%" },
                                legend: { position: "none" },
                            };

                            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                            chart.draw(chartData, options);
                        }
                    </script>

                    <div class="row">
                        <div class="col-lg-6">
                            <div id="piechart" style="width: 100%; height: 500px;"></div>
                        </div>
                        <div class="col-lg-6">
                            <div id="columnchart_values" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<script>

</script>

