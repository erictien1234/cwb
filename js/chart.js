var light_data = {
  Type: "LightChart",
  Light: ["RED", "RED", "RED", "ORANGE", "ORANGE", "ORANGE", "GREEN", "GREEN", "BLUE", "BLUE", "GREEN", "ORANGE"],  //共12個顏色可以選擇"RED","ORANGE","GREEN","BLUE"（由差到好）
  StartDate: "2019,09,01",
  EndDate: "2019,11,24",
  Location: "新竹縣",
  TimeScale: "week",
}

var pie_data = {
  Type: "PieChart",
  Valve:{
    datasets: [{
      data: [10, 20, 30],
      backgroundColor: [
      'Red',
      'Yellow',
      'Blue'
      ]
    }],
    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
      'Red',
      'Yellow',
      'Blue'
    ]
  }, 
  StartDate: "2019,09,01",
  EndDate: "2019,11,24",
  Location: "新竹縣",
}

var line_data = {
  Type: "LineChart",
  WaterStorage: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
      label: 'My First dataset',
      backgroundColor: 'green',
      borderColor: 'white',
      data: [1000, 1000, 900, 900, 800, 800, 700, 600, 500]
      },
    ]
  },
  StartDate: "2019,09,01",
  EndDate: "2019,11,24",
  Location: "新竹縣",
  TimeScale:"week",
}

var bar_data = {
  Type: "BarChart",
  WaterStorage: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
      label: 'My First dataset',
      backgroundColor: 'silver',
      borderColor: 'white',
      data: [1000, 1000, 900, 900, 800, 800, 700, 600, 500]
      },
    ]
  },
  StartDate: "2019,09,01",
  EndDate: "2019,11,24",
  Location: "新竹縣",
  TimeScale:"week",
}

// const lightChart_display = document.getElementById("lightChart");
const test_button_light = document.getElementById("singlesearchlight");
const test_button_pie = document.getElementById("singlesearchpie");
const test_button_line = document.getElementById("singlesearchline");
const test_button_bar = document.getElementById("singlesearchbar");

let light_id = [];
let week_date = [];


Date.prototype.addDays = function(days) {
  this.setDate(this.getDate() + days);
  return this;
}

test_button_light.addEventListener(
  'click',
  function() {
    //讀date
    light_data.StartDate = $("#sel4").val();

    //make HTML
    const lightChartContainer =document.createElement("div");
    lightChartContainer.setAttribute("id", "lightChartContainer");
    lightChartContainer.setAttribute("class", "container");
    const lightChart = document.createElement("div");
    lightChart.setAttribute("id", "lightChart");
    const imgSpanContainer = document.createElement("div");
    imgSpanContainer.setAttribute("class", "row");
    for (let i=0; i<12; i++) {
      const newSpan = document.createElement("span");
      const newImg = document.createElement("img");
      newImg.setAttribute("id", `light_${i+1}`);
      newImg.setAttribute("class", "waterLight_img");
      newSpan.setAttribute("class", "col-1")
      newSpan.appendChild(newImg);
      imgSpanContainer.appendChild(newSpan);
    }
    lightChart.appendChild(imgSpanContainer);
    const hr = document.createElement("hr");
    hr.setAttribute("class", "waterLight_hr");
    const spanOfHr = document.createElement("span");
    const hrContainer = document.createElement("div");
    spanOfHr.appendChild(hr);
    hrContainer.appendChild(spanOfHr);
    lightChart.appendChild(hrContainer);
    const pSpanContainer = document.createElement("div");
    pSpanContainer.setAttribute("style", "justify-content: space-between");
    for (let i=0; i<7; i++) {
      const newSpan = document.createElement("span");
      const newP = document.createElement("p");
      newP.setAttribute("id", `week${i+1}_date`);
      newP.setAttribute("class", "waterLight_date");
      newSpan.appendChild(newP);
      pSpanContainer.appendChild(newSpan);
    }
    lightChart.appendChild(pSpanContainer);
    lightChartContainer.appendChild(lightChart);
    document.getElementById("present").appendChild(lightChartContainer);
    
    // data input
    light_data.Light.forEach( function(value, idx) {
      light_id[idx] = document.getElementById(`light_${idx+1}`);
      if(value === 'RED') {
        light_id[idx].src = "../img/red_light.jpg"
      }else if(value === 'ORANGE') {
        light_id[idx].src = "../img/orange_light.jpg"
      }else if(value === 'GREEN') {
        light_id[idx].src = "../img/green_light.jpg"
      }else{
        light_id[idx].src = "../img/blue_light.jpg"
      }
    });

    for(i=0;i<6;i++){
      const firstday = new Date(light_data.StartDate.substring(0,4),light_data.StartDate.substring(5,7)-1,light_data.StartDate.substring(8,10));
      week_date.push(firstday.addDays(14*i).toString());
      // week_date.push(firstday.addDays(14*i).toString().substring(4,7)+firstday.addDays(14*i).toString().substring(8,10))
    }
    week_date.forEach( function(value, idx){
      let id = document.getElementById(`week${idx+1}_date`);
      id.innerText = value.substring(4,7)+value.substring(8,10);
    });
    // const hsc = '新竹縣'
    // $("path#" + hsc).addClass("focus");
    }
)

test_button_pie.addEventListener(
  'click',
  function() {
    pieChartContainer = document.createElement("div");
    pieChartContainer.setAttribute("id", "pieChartContainer");
    pieChartContainer.setAttribute("class", "container");
    pieCanvas = document.createElement("canvas");
    pieCanvas.setAttribute("id", "myPieChart");
    pieChartContainer.appendChild(pieCanvas);
    document.getElementById("present").appendChild(pieChartContainer);
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: pie_data.Valve,
    });
  }
)

test_button_line.addEventListener(
  'click',
  function() {
    lineChartContainer = document.createElement("div");
    lineChartContainer.setAttribute("id", "lineChartContainer");
    lineChartContainer.setAttribute("class", "container");
    lineCanvas = document.createElement("canvas");
    lineCanvas.setAttribute("id", "myLineChart");
    lineChartContainer.appendChild(lineCanvas);
    document.getElementById("present").appendChild(lineChartContainer);
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: line_data.WaterStorage,
    });
  }
)

test_button_bar.addEventListener(
  'click',
  function() {
    barChartContainer = document.createElement("div");
    barChartContainer.setAttribute("id", "barChartContainer");
    barChartContainer.setAttribute("class", "container");
    barCanvas = document.createElement("canvas");
    barCanvas.setAttribute("id", "myBarChart");
    barChartContainer.appendChild(barCanvas);
    document.getElementById("present").appendChild(barChartContainer);
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: bar_data.WaterStorage,
      // options = {
      //   scales: {
      //     xAxes: [{
      //       barPercentage: 0.5,
      //       barThickness: 6,
      //       maxBarThickness: 8,
      //       minBarLength: 2,
      //       gridLines: {
      //         offsetGridLines: true
      //       }
      //     }]
      //   }
      // },
    });
  }
)