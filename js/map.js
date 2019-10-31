function normalMap() {
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
              .attr("id", "mapSvg")
  var projection = d3.geoMercator().scale(4000).center([120.3,24]).translate([width/2,height/2]);
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

function rasterMap() {
  const color = ['#ff0000', '#fa001f', '#f30033', '#ed0045', '#e50055', '#df0062', '#d80071', '#d0007f', '#c8008c', '#c00097', '#b600a5', '#ad00ae', '#a200bc', '#9600c7', '#8a00d1', '#7b00dc', '#6d00e4', '#5900ee', '#3d00f7', '#0000ff'];
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
  var projection = d3.geoMercator().scale(4400).center([121,23.6]).translate([width/2,height/2]);
  var path = d3.geoPath().projection(projection);
  fetch('/json/taiwangrid.json') 
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
        .attr("Input_FID", function(d){
          return d.properties.Input_FID
        })
        .attr("x", function(d){
          return d.properties.x
        })
        .attr("y", function(d){
          return d.properties.y
        })
    });
}

function normalMap_point() {
  function convertGeoToPixel(latitude, longitude ,
    mapWidth , // in pixels
    mapHeight , // in pixels
    mapLonLeft , // in degrees
    mapLonDelta , // in degrees (mapLonRight - mapLonLeft);
    mapLatBottom , // in degrees
    mapLatBottomDegree) // in Radians
  {
  var x = (longitude - mapLonLeft) * (mapWidth / mapLonDelta);

  latitude = latitude * Math.PI / 180;
  var worldMapWidth = ((mapWidth / mapLonDelta) * 360) / (2 * Math.PI);
  var mapOffsetY = (worldMapWidth / 2 * Math.log((1 + Math.sin(mapLatBottomDegree)) / (1 - Math.sin(mapLatBottomDegree))));
  var y = mapHeight - ((worldMapWidth / 2 * Math.log((1 + Math.sin(latitude)) / (1 - Math.sin(latitude)))) - mapOffsetY);

  return { "x": x , "y": y};
  }
  let position = convertGeoToPixel(24.810836, 121.244576, 300, 400, 119.35, 2.2415, 21.5350, 3.647)

  newG = document.createElement("g");
  newCircle = document.createElement("circle");
  newG.setAttribute("style", "z-index: -1, position: absolute");
  newCircle = document.createElement("circle");
  newCircle.setAttribute("fill", "green");
  newCircle.setAttribute("cx", position.x);
  newCircle.setAttribute("cy", position.y);
  newCircle.setAttribute("r", "20");
  newG.appendChild(newCircle);
  document.getElementById("mapSvg").appendChild(newG);

  // let geoMultiPolygon;
  // let width = 300,
  //     height = 400;
  // let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
  //             .attr("viewBox", "0 0 " + width + " " + height)
  // var projection = d3.geoMercator().scale(4400).center([121,23.6]).translate([width/2,height/2]);
  // var path = d3.geoPath().projection(projection);
  // let filePath;
  // spatialType === "水庫" ? filePath === '/json/RESERVOIR.json':'/json/OBSERVATORY.json'
  // fetch(filePath) 
  //   .then(function(response) {
  //     return response.json();
  //   })
  //   .then(function(myJson) {
  //     geoMultiPolygon = myJson;
  //     console.log(geoMultiPolygon);
  //     svg.selectAll("path")
  //       .data(geoMultiPolygon.features)
  //       .enter()
  //       .append("path")
  //       .attr("class","map")
  //       .attr("d", path)
  //       .attr("Input_FID", function(d){
  //         return d.properties.Input_FID
  //       })
  //       .attr("x", function(d){
  //         return d.properties.x
  //       })
  //       .attr("y", function(d){
  //         return d.properties.y
  //       })
  //   });
}