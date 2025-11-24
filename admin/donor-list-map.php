<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_REQUEST['hidden'])) {
		$eid = intval($_GET['hidden']);
		$status = "0";
		$sql = "UPDATE tblblooddonars SET Status=:status WHERE  id=:eid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':eid', $eid, PDO::PARAM_STR);
		$query->execute();

		$msg = "Donor details hidden Successfully";
	}


	if (isset($_REQUEST['public'])) {
		$aeid = intval($_GET['public']);
		$status = 1;

		$sql = "UPDATE tblblooddonars SET Status=:status WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();

		$msg = "Donor details public";
	}
	//Code for Deletion
	if (isset($_REQUEST['del'])) {
		$did = intval($_GET['del']);
		$sql = "delete from tblblooddonars WHERE  id=:did";
		$query = $dbh->prepare($sql);
		$query->bindParam(':did', $did, PDO::PARAM_STR);
		$query->execute();

		$msg = "Record deleted Successfully ";
	}

	?>

	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>BBDMS | Donor List </title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<!-- <h2 class="page-title">Donors List</h2> -->

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Donors Info</div>
								<!-- <a href="download-records.php" style="font-size:16px;" class="btn btn-info">Download Donor
									List</a> -->
								<div class="panel-body">
									<?php if ($error) { ?>
										<div class="errorWrap">
											<strong>ERROR</strong>:<?php echo htmlentities($error); ?>
										</div><?php } else if ($msg) { ?>
											<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
									<?php } ?>


									<table id="zctb" class="display table table-striped table-bordered table-hover"
										cellspacing="0" width="100%">
										<tbody>

											<?php $sql = "SELECT * from  tblblooddonars ";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;

											$donors = [];

											if ($query->rowCount() > 0) {
												foreach ($results as $result) { ?>
													<!-- <tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><?php echo htmlentities($result->FullName); ?></td>
														<td><?php echo htmlentities($result->MobileNumber); ?></td>
														<td><?php echo htmlentities($result->EmailId); ?></td>
														<td><?php echo htmlentities($result->Gender); ?></td>
														<td><?php echo htmlentities($result->Age); ?></td>
														<td><?php echo htmlentities($result->BloodGroup); ?></td>
														<td><?php echo htmlentities($result->Address); ?></td>
														<td><?php echo htmlentities($result->Message); ?></td>
													</tr> -->
													<?php
													$donors[] = [
														'FullName' => $result->FullName,
														'Latitude' => $result->Latitude,  // Replace with actual latitude column if available
														'Longitude' => $result->Longitude, // Replace with actual longitude column if available
														'Address' => $result->Address,
														'Message' => $result->Message,
														'MobileNumber' => $result->MobileNumber,
														'BloodGroup' => $result->BloodGroup
													];

													$cnt = $cnt + 1;
												}
											} ?>

										</tbody>
									</table>

									<style>
										.info-window {
											font-family: 'Arial', sans-serif;
											color: #333;
											padding: 15px;
											border-radius: 8px;
											background-color: #fff;
											box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
											width: 250px;
											max-width: 100%;
											text-align: left;
										}

										.info-title {
											font-size: 18px;
											color: #007bff;
											margin: 0;
											padding-bottom: 10px;
											border-bottom: 2px solid #007bff;
										}

										.info-content {
											margin-top: 10px;
										}

										.info-content p {
											font-size: 14px;
											margin: 5px 0;
											color: #555;
										}

										.info-content p strong {
											font-weight: bold;
											color: #333;
										}

										.info-message {
											margin-top: 10px;
											font-size: 13px;
											color: #777;
										}

										.info-window a {
											color: #007bff;
											text-decoration: none;
										}

										.info-window a:hover {
											text-decoration: underline;
										}
									</style>
									<script>
										let map;

										async function initMap() {
											const positions = [
												<?php foreach ($donors as $donor) { ?> {
														position: {
															lat: <?php echo $donor['Latitude']; ?>,
															lng: <?php echo $donor['Longitude']; ?>
														},
														title: "<?php echo addslashes($donor['FullName']); ?>",
														content: `<div class="info-window">
																					<h3 class="info-title"><?php echo addslashes($donor['FullName']); ?></h3>
																					<div class="info-content">
																						<p><strong>Mobile:</strong> <?php echo addslashes($donor['MobileNumber']); ?></p>
																						<p><strong>Address:</strong> <?php echo addslashes($donor['Address']); ?></p>
																						<p><strong>Blood Group:</strong> <?php echo addslashes($donor['BloodGroup']); ?></p>
																					</div>
																				  </div>`
													},
												<?php } ?>
											];

											const infoWindow = new google.maps.InfoWindow();

											// Request needed libraries.
											//@ts-ignore
											const {
												Map
											} = await google.maps.importLibrary("maps");
											const {
												AdvancedMarkerElement
											} = await google.maps.importLibrary("marker");

											// Create the map, centered at the first position
											map = new Map(document.getElementById("map"), {
												zoom: 12,
												center: positions[0].position,
												mapId: "DEMO_MAP_ID",
											});

											// Add markers for each position
											positions.forEach(({
												position,
												title,
												content
											}) => {
												const marker = new AdvancedMarkerElement({
													map: map,
													position: position,
													title: title,
												});

												// Add click event to show the info window
												marker.addListener('click', () => {
													infoWindow.setContent(content);
													infoWindow.open({
														anchor: marker,
														map: map
													});
												});
											});
										}

										window.initMap = initMap;
									</script>
									<div id="map" style="height: 600px;"></div>

									<script
										src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5dxLnMHoeoCE5pyXvvpg8ZuNLYB0RTF0&callback=initMap&libraries=marker&v=beta&solution_channel=GMP_CCS_infowindows_v2"
										defer></script>

								</div>
							</div>



						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>