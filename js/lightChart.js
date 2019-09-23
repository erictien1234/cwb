var data = {
  Type: "LightChart",
  Light: ["RED", "RED", "RED", "ORANGE", "ORANGE", "ORANGE", "GREEN", "GREEN", "BLUE", "BLUE", "GREEN", "ORANGE"],  //共12個顏色可以選擇"RED","ORANGE","GREEN","BLUE"（由差到好）
  StartDate: "2019,09,01",
  EndDate: "2019,11,24",
  Location: "新竹縣",
  TimeScale: "week",
}

// const lightChart_display = document.getElementById("lightChart");
const test_button = document.getElementById("singlesearch");
let light_id = [];
let week_date = [];


Date.prototype.addDays = function(days) {
  this.setDate(this.getDate() + days);
  return this;
}

test_button.addEventListener(
  'click',
  function() {
    //讀date
    data.StartDate = $("#sel4").val();

    data.Light.forEach( function(value, idx) {
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
      const firstday =new Date(data.StartDate.substring(0,4),data.StartDate.substring(5,7)-1,data.StartDate.substring(8,10));

      // console.log(firstday.addDays(14*i));
      week_date.push(firstday.addDays(14*i).toString());
      // week_date.push(firstday.addDays(14*i).toString().substring(4,7)+firstday.addDays(14*i).toString().substring(8,10))
    }
    // console.log(week_date);
    week_date.forEach( function(value, idx){
      let id = document.getElementById(`week${idx+1}_date`);
      id.innerText = value.substring(4,7)+value.substring(8,10);
    });

    $("path.map").addClass("focus");
    }
)
