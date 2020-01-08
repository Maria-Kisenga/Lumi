<?php
include('db.php');
$id = $_REQUEST['id'];
//echo $id;
    include "chart/libchart/classes/libchart.php";
    header("Content-type: image/png");
    $chart = new PieChart(600, 400);
	//color1= white= neutral
	//color2= red= negative
    //color3= green = positive	
	$chart->getPlot()->getPalette()->setPieColor(array(new Color(254,152,130), new Color(108,167,211), new Color(252,236,89))); 
	 /*$chart->getPlot()->getPalette()->setBackgroundColor(array(
      new Color(50, 50, 50),
      new Color(50, 50, 50),
      new Color(50, 50, 50),
      new Color(50, 50, 50),
    ));*/
	//$chart->getPlot->setGraphPadding(new Padding(15, 10, 30, 30));
	//$chart-> getColor() -> setBackgroundColor(new Color(255, 255, 255, 0.8));
    $query = "Select (Select count(*) from reviews where label='negative' and recipe_id = $id) AS negative, (Select count(*) from reviews where label='neutral' and recipe_id = $id) as neutral, (Select count(*) from reviews where label='positive' and recipe_id = $id) as positive";
$data = mysqli_fetch_assoc(mysqli_query($db, $query));
//print_r ($data);
//$key = 'negative';
//$key = 'neutral';
//echo $data[$key];
    $negative=$data['negative'];
    $neutral=$data['neutral'];
	$positive = $data['positive'];
    $dataSet = new XYDataSet();
    $dataSet->addPoint(new Point("Negative", $negative));
    $dataSet->addPoint(new Point("Neutral", $neutral));
	$dataSet->addPoint(new Point("Positive", $positive));
    $chart->setDataSet($dataSet);
    $chart->setTitle("Summary of Positive, Neutral and Negative Reviews");
    $chart->render();
?>