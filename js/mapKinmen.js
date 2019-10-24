let geoMultiPolygon;
let width = 300,
    height = 400;
let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
            .attr("viewBox", "0 0 " + width + " " + height).style("background","white")
var projection = d3.geoMercator().scale(20000).center([118.40,24.4]).translate([width/2,height/2]);
var path = d3.geoPath().projection(projection);
fetch('/json/TaiwanCountySimplify2.json')
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
