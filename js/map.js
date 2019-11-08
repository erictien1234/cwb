function cleanMaps() {
  document.getElementById("map").innerHTML = "";
}

// function normalMap(mapstate) {
//   let geoMultiPolygon;
//   let width = 300,
//       height = 400;
//   let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
//               .attr("viewBox", "0 0 " + width + " " + height)
//               .attr("id", "mapSvg")
//   var projection = d3.geoMercator().scale(6000).center([120.7,23.6]).translate([width/2,height/2]);
//   var path = d3.geoPath().projection(projection);
//   fetch('/json/TaiwanCountySimplify.json') //TaiwanCountySimplify.json//
//     .then(function(response) {
//       return response.json();
//     })
//     .then(function(myJson) {
//       geoMultiPolygon = myJson;
//       console.log(geoMultiPolygon);
//       svg.selectAll("path")
//         .data(geoMultiPolygon.features)
//         .enter()
//         .append("path")
//         .attr("class","map")
//         .attr("style", "z-index: 1")
//         .attr("d", path)
//         .attr("id", function(d){
//           return d.properties.NAME_2014
//         })
//     });
//   if (mapstate !== undefined) {
//     document.getElementById(mapstate).setAttribute("style","fill: red");
//     // $("path#"+$("#sel3 :selected").text()).css("fill",'red');
//     // console.log($("#sel3 :selected").text());
//   }
// }

function rasterMap(rasterData, max, min, unit) {
  console.log(rasterData);
  const color = ['#ff0000', '#fa001f', '#f30033', '#ed0045', '#e50055', '#df0062', '#d80071', '#d0007f', '#c8008c', '#c00097', '#b600a5', '#ad00ae', '#a200bc', '#9600c7', '#8a00d1', '#7b00dc', '#6d00e4', '#5900ee', '#3d00f7', '#0000ff'];
  for(let i = 0; i<rasterData.length; i++){
    let scale = Math.min(Math.floor((rasterData[i].value-min)/((max-min)/color.length)), color.length-1);
    rasterData[i].color = color[scale];
  }
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
  var projection = d3.geoMercator().scale(5500).center([121.2,23.6]).translate([width/2,height/2]);
  var path = d3.geoPath().projection(projection);

  fetch('/json/taiwangrid.json')
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      response.features.map((item) => {
        item.properties.color = "gray";
        for(let i = 0; i < rasterData.length; i++) {
          if (rasterData[i].x === item.properties.x && rasterData[i].y === item.properties.y) {
            item.properties.color = rasterData[i].color;
            break;
          }
        }
        return item;
      })
      console.log(response);
      return response
    })
    .then(function(myJson) {
      geoMultiPolygon = myJson;
      console.log(geoMultiPolygon);
      svg.selectAll("path")
        .data(geoMultiPolygon.features)
        .enter()
        .append("path")
        .attr("class","map")
        .attr("d", path)
        .attr("Input_FID", function(d){
          return d.properties.Input_FID
        })
        .attr("x", function(d){
          return d.properties.x
        })
        .attr("y", function(d){
          return d.properties.y
        })
        .attr("style", function(d){
          return "fill: "+d.properties.color
        })
    });

  //Make legend
  let Lposition = [230, 180]; //[x, y]
  let Lsize = [10, 200]; //[x, y]
  let defs = svg.append("defs");
  let linearGradient = defs.append("linearGradient")
    .attr("id", "linear-gradient")
    .attr("x1", "0%")
    .attr("y1", "100%")
    .attr("x2", "0%")
    .attr("y2", "0%");
  linearGradient.append("stop")
    .attr("offset", "0%")
    .attr("stop-color", '#ff0000');

  linearGradient.append("stop")
    .attr("offset", "100%")
    .attr("stop-color", "#0000ff");
  svg.append("rect")
    .attr("width", Lsize[0])
    .attr("height", Lsize[1])
    // .attr("style", function(d){
    //   return "margin-right: 10px"
    // })
    .attr("x", Lposition[0])
    .attr("y", Lposition[1])
    .style("fill", "url(#linear-gradient)");

  svg.selectAll("text")
    .data([
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0, label: Math.round(min*100)/100 },
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.1, label: Math.round((min+(max-min)*0.1)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.2, label: Math.round((min+(max-min)*0.2)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.3, label: Math.round((min+(max-min)*0.3)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.4, label: Math.round((min+(max-min)*0.4)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.5, label: Math.round((min+(max-min)*0.5)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.6, label: Math.round((min+(max-min)*0.6)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.7, label: Math.round((min+(max-min)*0.7)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.8, label: Math.round((min+(max-min)*0.8)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*0.9, label: Math.round((min+(max-min)*0.9)*100)/100},
      {x:Lposition[0]+Lsize[0]+5, y: Lposition[1]+Lsize[1]+5-Lsize[1]*1, label: Math.round(max*100)/100}
    ])
    .enter().append("text")
    .style("font-size", "12px")
    .attr("x", function(d) { return d.x; })
    .attr("y", function(d) { return d.y; })
    .text(function(d) { return d.label; });
  svg.append("text")
    .style("font-size", "12px")
    .text(unit)
    .attr("x", 230)
    .attr("y", 160)
}

function normalMap() {
  // let spatialType = "水庫" ;
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
  var projection = d3.geoMercator().scale(6000).center([120.7,23.6]).translate([width/2,height/2]);
  var path = d3.geoPath().projection(projection);
  let filePathR = '/json/RESERVOIR.json';
  let filePathO = '/json/OBSERVATORY.json';
  let filePathI = '/json/IRRIGATION.json';
  let filePathT = '/json/twtownsimplify.json';
  // spatialType === "水庫" ? filePath = '/json/RESERVOIR.json': filePath ='/json/OBSERVATORY.json'
  fetch('/json/TaiwanCountySimplify.json')
    .then(function(response) {
      return response.json();
    })
    .then(function(myJson) {
      geoMultiPolygon = myJson;
      console.log(geoMultiPolygon);
      svg.selectAll("path")
        .data(geoMultiPolygon.features)
        .enter()
        .append("path")
        .attr("class","map")
        .attr("d", path)
        .attr("id", function(d){
          return d.properties.Name
        })
    });
  fetch(filePathI)
    .then(function(response) {
      return response.json();
    })
    .then(function(myJson) {
      geoMultiPolygon = myJson;
      console.log(geoMultiPolygon);
      svg.selectAll("circle")
        .data(geoMultiPolygon.features)
        .enter()
        .append("path")
        .attr("class","map_point")
        .attr("d", path)
        .attr("id", function(d){
          return d.properties.Name
        })
    });
  fetch(filePathT)
    .then(function(response) {
      return response.json();
    })
    .then(function(myJson) {
      geoMultiPolygon = myJson;
      console.log(geoMultiPolygon);
      svg.selectAll("circle")
        .data(geoMultiPolygon.features)
        .enter()
        .append("path")
        .attr("class","map_point")
        .attr("d", path)
        .attr("id", function(d){
          return d.properties.Name
        })
    });
  fetch(filePathR)
    .then(function(response) {
      return response.json();
    })
    .then(function(myJson) {
      geoMultiPolygon = myJson;
      console.log(geoMultiPolygon);
      svg.selectAll("circle")
        .data(geoMultiPolygon.features)
        .enter()
        .append("path")
        .attr("class","map_point")
        .attr("d", path)
        .attr("id", function(d){
          return d.properties.Name;
        })
    });
  fetch(filePathO)
    .then(function(response) {
      return response.json();
    })
    .then(function(myJson) {
      geoMultiPolygon = myJson;
      console.log(geoMultiPolygon);
      svg.selectAll("circle")
        .data(geoMultiPolygon.features)
        .enter()
        .append("path")
        .attr("class","map_point")
        .attr("d", path)
        .attr("id", function(d){
          return d.properties.Name
        })
    });
}

function changemapcolor(mapstate, color){
  if (color === 'none') {
    mapstate.area.forEach(item => {
      document.getElementById(item).setAttribute("style",`fill: ${color}`);
    });
    mapstate.point.forEach(item => {
      document.getElementById(item).setAttribute("style",`fill: ${color};stroke: none`);
    });
  } else{
    mapstate.area.forEach(item => {
      document.getElementById(item).setAttribute("style",`fill: ${color}`);
    });
    mapstate.point.forEach(item => {
      document.getElementById(item).setAttribute("style",`fill: ${color};stroke: black`);
    });
  }

}
