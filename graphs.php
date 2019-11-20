<?php

require_once 'db.php';

$load = $_POST["load"];

if (isset($load)) {
?>
<script>
	// ------------------------ Random Colors for bars --------------------------
	var myColor1 = [];
	var myColor2 = [];
    
	//-------------------------------- chart 1 ---------------------------------
	var ctx1 = document.getElementById('chartContainer1');
	var chart1 = new Chart(ctx1, {
	    type: 'bar',
	    data: {
	        labels: [
	        <?php
			foreach ($conn->query("SELECT main_inventory_type FROM added_inventory GROUP BY main_inventory_type") as $key => $val) {
			   	echo '"'.$val['main_inventory_type'].'",';
			}
			?> 
	        ],
	        datasets: [{
	            label: 'Inventories',
	            backgroundColor: '#f56e4a',
	            data: [
	            <?php
				foreach ($conn->query("SELECT main_inventory_type, COUNT(quantity) AS num1 FROM added_inventory GROUP BY main_inventory_type") as $key => $val) {
				   	echo $val['num1'].',';
				}
				?> 
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	    	legend: {
	    		display: false
	    	},
	    	scales: {
				yAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Number of Inventories'
					},
					ticks: {
	                    beginAtZero: true
	                }
				}],
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Main Inventory Types'
					}
				}]
			},
			tooltips: {
	            titleFontSize: 13
			},
	    	plugins: {
	    		labels: false
	    	}
	    }
	});

	//------------------------------------ chart 2 -------------------------------------
	var ctx2 = document.getElementById('chartContainer2').getContext('2d');
	<?php
	foreach ($conn->query("SELECT COUNT(main_location) FROM added_inventory GROUP BY main_location") as $key => $val) {
	?>
	myColor1.push("rgba("+Math.floor((Math.random() * 256) + 1).toString()+"," +Math.floor((Math.random() * 256) + 1).toString()+","+Math.floor((Math.random() * 256) + 1).toString()+",1)");
	<?php
	}
	?>
	var chart2 = new Chart(ctx2, {
	    type: 'doughnut',
	    data: {
	        labels: [
	        <?php
			foreach ($conn->query("SELECT main_location FROM added_inventory GROUP BY main_location ASC") as $key => $val) {
			   	echo '"'.$val['main_location'].'",';
			}
			?> 
			],
	    	datasets: [{
	    		borderWidth: 0.5,
	    		backgroundColor: myColor1,
	            data: [
	            <?php
				foreach ($conn->query("SELECT main_location, COUNT(quantity) AS num2 FROM added_inventory GROUP BY main_location ASC") as $key => $val) {
					echo $val["num2"].',';
				}
				?> 
	            ]
	        }]
	    },
	    options: {
	    	tooltips:{
	    		callbacks: {
	                title: function(tooltipItem, data) {
			          return data['labels'][tooltipItem[0]['index']];
			        },
			        label: function(tooltipItem, data) {
			          return ' Inventories : '+data['datasets'][0]['data'][tooltipItem['index']];
			        },
			        afterLabel: function(tooltipItem, data) {
			          var dataset = data['datasets'][0];
			          <?php
			          $total_q = '';
					  $sql2 = "SELECT SUM(quantity) AS total FROM added_inventory";
					  $sql2_rslt = mysqli_query($conn,$sql2);
					  $total_q = mysqli_fetch_array($sql2_rslt);
					  $total = $total_q["total"];
			          ?>
			          var sum = <?php echo $total; ?>;
			          var percent = Math.round((dataset['data'][tooltipItem['index']] / sum) * 100);
			          return ' (' + percent + '%)';
			        }
	            },
			    titleFontSize: 14
	    	},
	    	plugins: {
	    		labels: {
	    			render: 'percentage',
	    			fontColor: '#000',
	    			fontStyle: 'bold',
	    			fontSize: 13,
	    			position: 'outside',
	    			fontFamily: 'Roboto',
	    			precision: 1,
	    			textMargin: 3
	    		}
	    	}
	    }
	});

	//--------------------------------------- chart 3 ----------------------------------------
	var ctx3 = document.getElementById('chartContainer3');
	var chart3 = new Chart(ctx3, {
	    type: 'horizontalBar',
	    data: {
	        labels: [
	        <?php
			foreach ($conn->query("SELECT main_location FROM added_inventory GROUP BY main_location ASC") as $key => $val) {
			   	echo '"'.$val['main_location'].'",';
			}
			?> 
	        ],
	        datasets: [{
	            label: 'Inventories',
	            backgroundColor: '#62f083',
	            data: [
	            <?php
				foreach ($conn->query("SELECT main_location, COUNT(quantity) AS num2 FROM added_inventory GROUP BY main_location ASC") as $key => $val) {
					echo $val["num2"].',';
				}
				?> 
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	    	legend: {
	    		display: false
	    	},
	    	scales: {
				yAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Main Locations'
					}
				}],
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Number of Inventories'
					},
					ticks: {
	                    beginAtZero: true
	                }
				}]
			},
			tooltips: {
	            titleFontSize: 13
			}
	    }
	});

	//------------------------------------------ chart 4 -------------------------------------------
	var ctx4 = document.getElementById('chartContainer4').getContext('2d');
	<?php
	foreach ($conn->query("SELECT COUNT(sub_location) FROM added_inventory GROUP BY sub_location") as $key => $val) {
	?>
	myColor2.push("rgba("+Math.floor((Math.random() * 256) + 1).toString()+"," +Math.floor((Math.random() * 256) + 1).toString()+","+Math.floor((Math.random() * 256) + 1).toString()+",1)");
	<?php
	}
	?>
	var chart4 = new Chart(ctx4, {
	    type: 'doughnut',
	    data: {
	        labels: [
	        <?php
			foreach ($conn->query("SELECT sub_location, COUNT(quantity) AS num3 FROM added_inventory GROUP BY sub_location ASC") as $key => $val) {
			   	echo '"'.$val['sub_location'].'",';
			}
			?> 
			],
	    	datasets: [{
	    		borderWidth: 0.5,
	    		backgroundColor: myColor2,
	            data: [
	            <?php
				foreach ($conn->query("SELECT sub_location, COUNT(quantity) AS num3 FROM added_inventory GROUP BY sub_location ASC") as $key => $val) {
				   	echo $val['num3'].',';
				}
				?> 
	            ]
	        }]
	    },
	    options: {
	    	tooltips:{
	    		callbacks: {
	                title: function(tooltipItem, data) {
			          return data['labels'][tooltipItem[0]['index']];
			        },
			        label: function(tooltipItem, data) {
			          return ' Inventories : '+data['datasets'][0]['data'][tooltipItem['index']];
			        },
			        afterLabel: function(tooltipItem, data) {
			          var dataset = data['datasets'][0];
			          <?php
			          $total_q = '';
					  $sql3 = "SELECT SUM(quantity) AS total FROM added_inventory";
					  $sql3_rslt = mysqli_query($conn,$sql3);
					  $total_q = mysqli_fetch_array($sql3_rslt);
					  $total = $total_q["total"];
			          ?>
			          var sum = <?php echo $total; ?>;
			          var percent = Math.round((dataset['data'][tooltipItem['index']] / sum) * 100);
			          return ' (' + percent + '%)';
			        }
	            },
	            titleFontSize: 14
	    	},
	    	plugins: {
	    		labels: {
	    			render: 'percentage',
	    			fontColor: '#000',
	    			fontStyle: 'bold',
	    			fontSize: 13,
	    			position: 'outside',
	    			fontFamily: 'Roboto',
	    			precision: 1,
	    			textMargin: 3
	    		}
	    	}
	    }
	});

	//---------------------------------------- chart 5 -----------------------------------------
	var ctx5 = document.getElementById('chartContainer5');
	var chart5 = new Chart(ctx5, {
	    type: 'horizontalBar',
	    data: {
	        labels: [
	        <?php
			foreach ($conn->query("SELECT sub_location, COUNT(quantity) AS num3 FROM added_inventory GROUP BY sub_location ASC") as $key => $val) {
			   	echo '"'.$val['sub_location'].'",';
			}
			?> 
	        ],
	        datasets: [{
	            label: 'Inventories',
	            backgroundColor: '#7dabd0',
	            data: [
	            <?php
				foreach ($conn->query("SELECT sub_location, COUNT(quantity) AS num3 FROM added_inventory GROUP BY sub_location ASC") as $key => $val) {
				   	echo $val['num3'].',';
				}
				?>
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	    	legend: {
	    		display: false
	    	},
	    	scales: {
				yAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Sub Locations'
					}
				}],
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Number of Inventories'
					},
					ticks: {
	                    beginAtZero: true
	                }
				}]
			},
			tooltips: {
	            titleFontSize: 13
			}
	    }
	});

	//-------------------------------------- chart 6 ---------------------------------------
	var ctx6 = document.getElementById('chartContainer6').getContext('2d');
	var chart6 = new Chart(ctx6, {
	    type: 'line',
	    data: {
	        labels: [
	        <?php
			foreach ($conn->query("SELECT purchased_date FROM added_inventory GROUP BY purchased_date LIMIT 15") as $key => $val) {
			   	echo '"'.$val['purchased_date'].'",';
			}
			?> 
			],
	    	datasets: [{
	    		label: "Purchasements",
	    		backgroundColor: 'rgba(194, 30, 86,0.4)',
				borderColor: '#c21e56',
				pointBorderWidth: 5,
				pointHoverBorderWidth: 5,
	            data: [
	            <?php
				foreach ($conn->query("SELECT purchased_date, COUNT(quantity) AS num4 FROM added_inventory GROUP BY purchased_date LIMIT 15") as $key => $val) {
					echo $val['num4'].',';
				}
				?> 
	            ]
	        }]
	    },
	    options: {
	    	title: {
				display: false
			},
	    	legend: {
	    		display: false
	    	},
	    	scales: {
				yAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Number of Inventories'
					},
					ticks: {
		                beginAtZero: true
		            }
				}],
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Purchased Date'
					}
				}]
			},
			tooltips:{
				titleFontSize: 14,
				mode: 'index',
				intersect: false
			}
	    }
	});
	Chart.platform.disableCSSInjection = true;
</script>
<!-- <canvas id="myChart" width="400" height="400"></canvas> -->
<div class="dash-graph-content">
	<div class="graph-title"><i class="fas fa-boxes fa-lg"></i> Main Inventory Categories</div>
	<div class="graph-chart" id="graph-chart1"><canvas id="chartContainer1" style="height: 300px; width: 100%;"></canvas></div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<div class="dash-graph-content">
			<div class="graph-title"><i class="fas fa-building fa-lg"></i> Main Location-wise</div>
			<div class="graph-chart" id="graph-chart2"><canvas id="chartContainer2" style="height: 350px; width: 100%;"></canvas></div>
			<hr>
			<div class="graph-chart" id="graph-chart5"><canvas id="chartContainer3" style="height: 450px; width: 100%;"></canvas></div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="dash-graph-content">
			<div class="graph-title"><i class="fas fa-sitemap"></i> Sub Location-wise</div>
			<div class="graph-chart" id="graph-chart3"><canvas id="chartContainer4" style="height: 350px; width: 100%;"></canvas></div>
			<hr>
			<div class="graph-chart" id="graph-chart6"><canvas id="chartContainer5" style="height: 450px; width: 100%;"></canvas></div>
		</div>
	</div>
</div>
<br>
<div class="dash-graph-content">
	<div class="graph-title"><i class="fas fa-coins fa-lg"></i> Purchases</div>
	<div class="graph-chart" id="graph-chart4"><canvas id="chartContainer6" style="height: 300px; width: 100%;"></canvas></div>
</div>
<?php
}

?>