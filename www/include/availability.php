<div class="availability-container">
	
	<?php
		include_once 'database.php';		

		$db = new Database;

		$query = $db->get_lots();

		foreach($query[1] as $lot ){
			echo "
			<div class='availability-container-item' id='lot$lot->lotId'>
				<p>$lot->lotName</p>
				<p>$lot->location</p>
				<p>$lot->fullness% full</p>
			</div>
			";
		}

	?>
	
</div>

<div class="availability-modal-container" id="availabilityModal">
    <div class="availability-modal-display">
        <div class="availability-modal-content" id="availabilityModalContent">
            
        </div>
        <div class="availability-modal-close" id="availabilityModalClose">&times;</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    const availabilityItem = document.querySelectorAll('.availability-container-item');
    const availabilityModal = document.getElementById("availabilityModal");
    const availabilityModalClose = document.getElementById("availabilityModalClose");
    const availabilityModalContent = document.getElementById("availabilityModalContent");

    availabilityItem.forEach(availabilityItem => 
    {
        availabilityItem.addEventListener('click', () => {
            console.log(availabilityItem.id);
            availabilityModal.style.display = "flex";

            const LOGIN_STATUS = window.localStorage.getItem("LOGIN_STATUS");

            if (LOGIN_STATUS == "0") // if user is not logged in display login modal
            {
                availabilityModalContent.innerHTML = `
                    <?php
                        include("login_modal.php");
                    ?>
                `;
            }
            else {
                // This will be replace with another include for the forecast and other info
                availabilityModalContent.innerHTML = `                   
                    <?php
                        include("forecast.php");
                    ?>
                `;

                // Since by default the chart displays data for the current day,
                // set the default value of the select dropdown menu to be the current day rather than 'Sunday'.
                document.getElementById("forecast-day").value = "<?php echo $forecast_day; ?>";

                /**********  AVAILABILITY CHART **********/

                // Context for the actual canvas that the chart is drawn to.
                const ctx = document.getElementById('forecast-graph');

                // Graph title.
                const graph_label = "<?php echo $forecast_day_name ?>";

                // Time labels for the x axis of the chart.
                const l1 = '6';
                const l2 = '7';
                const l3 = '8';
                const l4 = '9';
                const l5 = '10';
                const l6 = '11';
                const l7 = '12';
                const l8 = '1';
                const l9 = '2';
                const l10 = '3';
                const l11 = '4';
                const l12 = '5';
                
                // Data for the chart.
                // d1 corresponds to l1, d2 to l2, and so on.
                const d1 = "<?php echo $chart_data['06'] ?>";
                const d2 = "<?php echo $chart_data['07'] ?>";
                const d3 = "<?php echo $chart_data['08'] ?>";
                const d4 = "<?php echo $chart_data['09'] ?>";
                const d5 = "<?php echo $chart_data['10'] ?>";
                const d6 = "<?php echo $chart_data['11'] ?>";
                const d7 = "<?php echo $chart_data['12'] ?>";
                const d8 = "<?php echo $chart_data['13'] ?>";
                const d9 = "<?php echo $chart_data['14'] ?>";
                const d10 = "<?php echo $chart_data['15'] ?>";
                const d11 = "<?php echo $chart_data['16'] ?>";
                const d12 = "<?php echo $chart_data['17'] ?>";

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [l1, l2, l3, l4, l5, l6, l7, l8, l9, l10, l11, l12],
                        datasets: [{
                            label: graph_label,
                            data: [d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12],
                            borderWidth: 1,
                            // Colors bars based on value of data.
                            backgroundColor: function(context) {
                                var value = context.dataset.data[context.dataIndex];
                                if (value > 80) {
                                    return 'rgba(255, 99, 132, 0.2)'; // Red 
                                } else if (value > 60) {
                                    return 'rgba(255, 221, 99, 0.2)'; // Yellow
                                } else {
                                    return 'rgba(120, 190, 120, 0.2)'; // Green
                                }
                            },
                            borderColor: function(context) {
                                var value = context.dataset.data[context.dataIndex];
                                if (value > 80) {
                                    return 'rgb(255, 99, 132)'; // Red
                                } else if (value > 60) {
                                    return 'rgb(255, 221, 99)'; // Yellow
                                } else {
                                    return 'rgb(120, 190, 120)'; // Green
                                }
                            }
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Time'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: '% Full'
                                },
                                beginAtZero: true,
                                max: 100
                            }
                        },
                        legend: {
                            display: false
                        }
                    }
                });
                /**********  END AVAILABILITY CHART **********/

            }
        })
    });

    availabilityModalClose.addEventListener("click", () => {
        availabilityModal.style.display = "none";
    })

</script>