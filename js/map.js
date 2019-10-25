function normalMap() {
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
  var projection = d3.geoMercator().scale(5800).center([120.7,23.6]).translate([width/2,height/2]);
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
        .attr("d", path)
        .attr("id", function(d){
          return d.properties.NAME_2014
        })
    });
}

function rasterMap() {
  let geoMultiPolygon;
  let width = 300,
      height = 400;
  let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
              .attr("viewBox", "0 0 " + width + " " + height)
  var projection = d3.geoMercator().scale(5800).center([120.7,23.6]).translate([width/2,height/2]);
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
