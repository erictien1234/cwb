Date.prototype.addDays = function(days) {
  this.setDate(this.getDate() + days);
  return this;
}

function cleanCanvas() {
  document.getElementById("present").innerHTML = "";
}

function lightChart(light_data,counter) {
  // var light_data = {
  //   Type: "I",
  //   Light: ["RED", "RED", "RED", "ORANGE", "ORANGE", "ORANGE", "GREEN", "GREEN", "BLUE", "BLUE", "GREEN", "ORANGE"],  //共12個顏色可以選擇"RED","ORANGE","GREEN","BLUE"（由差到好）
  //   TimeScale: "週",
  // }
  let light_id = [];
  let week_date = [];
  //讀date
  StartDate = $("#sel4").val();

  //make HTML
  const lightChartContainer =document.createElement("div");
  lightChartContainer.setAttribute("id", `lightChartContainer${counter}`);
  // lightChartContainer.setAttribute("class", "container");
  // const lightChart = document.createElement("div");
  // lightChart.setAttribute("id", "lightChart");
  const imgSpanContainer = document.createElement("div");
  imgSpanContainer.setAttribute("class", "row flex-row flex-nowrap");
  for (let i=0; i<12; i++) {
    const newSpan = document.createElement("span");
    const newImg = document.createElement("img");
    newImg.setAttribute("id", `light_${i+1}_${counter}`);
    newImg.setAttribute("class", "waterLight_img");
    newSpan.setAttribute("style", "flex:0.25 0.25;margin-left: 1% ;margin-right: 1%")
    newSpan.appendChild(newImg);
    imgSpanContainer.appendChild(newSpan);
  }
  lightChartContainer.appendChild(imgSpanContainer);
  const hr = document.createElement("hr");
  hr.setAttribute("class", "waterLight_hr");
  // const spanOfHr = document.createElement("span");
  const hrContainer = document.createElement("div");
  // spanOfHr.appendChild(hr);
  // hrContainer.appendChild(hr);
  lightChartContainer.appendChild(hr);
  const pSpanContainer = document.createElement("div");
  pSpanContainer.setAttribute("class", "row flex-nowrap");
  // pSpanContainer.setAttribute("style", "justify-content: space-between");
  for (let i=0; i<6; i++) {
    const newSpan = document.createElement("span");
    const newP = document.createElement("p");
    // newSpan.setAttribute("class", "col-1");
    newSpan.setAttribute("style", "text-align:left;flex:0.5 0.5;margin-left:1.5%;margin-right:1.5%");
    newP.setAttribute("id", `week${i+1}_date_${counter}`);
    newP.setAttribute("class", "waterLight_date");
    newSpan.appendChild(newP);
    pSpanContainer.appendChild(newSpan);
  }
  lightChartContainer.appendChild(pSpanContainer);
  // lightChartContainer.appendChild(lightChart);
  document.getElementById("present").appendChild(lightChartContainer);

  // data input
  light_data.Light.forEach( function(value, idx) {
    light_id[idx] = document.getElementById(`light_${idx+1}_${counter}`);
    if(value === 'red') {
      light_id[idx].src = "../img/red_light.jpg"
    }else if(value === 'orange') {
      light_id[idx].src = "../img/orange_light.jpg"
    } else if (value === 'yellow') {
      light_id[idx].src = "../img/yellow_light.jpg"
    } else if(value === 'green') {
      light_id[idx].src = "../img/green_light.jpg"
    }else{
      light_id[idx].src = "../img/blue_light.jpg"
    }
  });

  for(i=0;i<6;i++){
    const firstday = new Date(StartDate.substring(0,4),StartDate.substring(5,7)-1,StartDate.substring(8,10));
    week_date.push(firstday.addDays(14*i).toString());
    // week_date.push(firstday.addDays(14*i).toString().substring(4,7)+firstday.addDays(14*i).toString().substring(8,10))
  }
  week_date.forEach( function(value, idx){
    let id = document.getElementById(`week${idx+1}_date_${counter}`);
    id.innerText = value.substring(4,7)+value.substring(8,10);
  });
  // const hsc = '新竹縣'
  // $("path#" + hsc).addClass("focus");
}

function pieChart(pie_data,counter) {
  // var pie_data = {
  //   Type: "A",
  //   Valve:{
  //     datasets: [{
  //       data: [10, 20, 30],
  //       backgroundColor: [
  //       'Red',
  //       'Yellow',
  //       'Blue'
  //       ]
  //     }],
  //     // These labels appear in the legend and in the tooltips when hovering different arcs
  //     labels: [
  //       'Red',
  //       'Yellow',
  //       'Blue'
  //     ]
  //   },
  // }

  StartDate = $("#sel4").val();
  pieChartContainer = document.createElement("div");
  pieChartContainer.setAttribute("id", `pieChartContainer${counter}`);
  pieChartContainer.setAttribute("class", "container");
  pieCanvas = document.createElement("canvas");
  pieCanvas.setAttribute("id", `myPieChart${counter}`);
  pieChartContainer.appendChild(pieCanvas);
  document.getElementById("present").appendChild(pieChartContainer);
  var ctx = document.getElementById(`myPieChart${counter}`).getContext('2d');
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: pie_data.Valve,
  });
}


function lineChart(line_data,counter) {
  // var line_data = {
  //   Type: "D",
  //   WaterStorage: {
  //     labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  //     datasets: [
  //       {
  //       label: 'My First dataset',
  //       backgroundColor: 'green',
  //       borderColor: 'white',
  //       data: [1000, 1000, 900, 900, 800, 800, 700, 600, 500]
  //       },
  //     ]
  //   },
  //   StartDate: "2019,09,01",
  //   Location: "新竹縣",
  //   TimeScale:"週",
  // }
  console.log(line_data);
  lineChartContainer = document.createElement("div");
  lineChartContainer.setAttribute("id", `lineChartContainer${counter}`);
  lineChartContainer.setAttribute("class", "container");
  lineCanvas = document.createElement("canvas");
  lineCanvas.setAttribute("id", `myLineChart${counter}`);
  lineChartContainer.appendChild(lineCanvas);
  document.getElementById("present").appendChild(lineChartContainer);
  var ctx = document.getElementById(`myLineChart${counter}`).getContext('2d');
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: line_data.WaterStorage,
    options: line_data.options,
  });
}


function barChart(bar_data,counter) {
// var line_data = {
  //   Type: "D",
  //   WaterStorage: {
  //     yAxisID: "萬噸"
  //     labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  //     datasets: [
  //       {
  //       label: 'My First dataset',
  //       backgroundColor: 'silver',
  //       borderColor: 'white',
  //       data: [1000, 1000, 900, 900, 800, 800, 700, 600, 500]
  //       },
  //     ]
  //   },
  //   StartDate: "2019,09,01",
  //   Location: "新竹縣",
  //   TimeScale:"週",
  // }

  barChartContainer = document.createElement("div");
  barChartContainer.setAttribute("id", `barChartContainer${counter}`);
  barChartContainer.setAttribute("class", "container");
  barCanvas = document.createElement("canvas");
  barCanvas.setAttribute("id", `myBarChart${counter}`);
  barChartContainer.appendChild(barCanvas);
  document.getElementById("present").appendChild(barChartContainer);
  var ctx = document.getElementById(`myBarChart${counter}`).getContext('2d');
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: bar_data.WaterStorage,
    options: bar_data.options,
  });
}
