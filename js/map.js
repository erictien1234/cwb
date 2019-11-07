function cleanMaps() {
  document.getElementById("map").innerHTML = "";
}

function normalMap() {
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
              .attr("id", "mapSvg")
  var projection = d3.geoMercator().scale(6000).center([120.7,23.6]).translate([width/2,height/2]);
  var path = d3.geoPath().projection(projection);
  fetch('/json/TaiwanCountySimplify.json') //TaiwanCountySimplify.json//
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
        .attr("style", "z-index: 1")
        .attr("d", path)
        .attr("id", function(d){
          return d.properties.NAME_2014
        })
    });
}

function rasterMap(rasterData, max, min) {
  console.log(rasterData);
  const color = ['#ff0000', '#fa001f', '#f30033', '#ed0045', '#e50055', '#df0062', '#d80071', '#d0007f', '#c8008c', '#c00097', '#b600a5', '#ad00ae', '#a200bc', '#9600c7', '#8a00d1', '#7b00dc', '#6d00e4', '#5900ee', '#3d00f7', '#0000ff'];
  for(let i = 0; i<rasterData.length; i++){
    let scale = Math.floor((rasterData[i].value-min)/((max-min)/color.length))
    rasterData[i].color = color[scale];
  }
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
  var projection = d3.geoMercator().scale(6000).center([120.7,23.6]).translate([width/2,height/2]);
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
}

function normalMap_point(spatialType) {
  // let spatialType = "水庫" ;
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
  var projection = d3.geoMercator().scale(6000).center([120.7,23.6]).translate([width/2,height/2]);
  var path = d3.geoPath().projection(projection);
  let filePath;
  spatialType === "水庫" ? filePath = '/json/RESERVOIR.json': filePath ='/json/OBSERVATORY.json'
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
          return d.properties.NAME_2014
        })
    });
  fetch(filePath)
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
        .attr("class","map_point")
        .attr("d", path)
        .attr("id", function(d){
          return d.properties.ObservatoryName
        })
    });
}
