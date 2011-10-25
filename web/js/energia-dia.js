// Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(initialize);

function initialize() {
  // Replace the data source URL on next line with your data source URL.
  // Specify that we want to use the XmlHttpRequest object to make the query.
  var query = new google.visualization.Query('http://sgeudec/energia/DiaGetData');
  
  // Send the query with a callback function.
  query.send(handleQueryResponse);
}

function handleQueryResponse(response) {

  if (response.isError()) {
    alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
    return;
  }

  var data = response.getDataTable();
  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
  chart.draw(data, {width:700, height:450, is3D:true});
}
