let geoMultiPolygon;
let width = 300,
height = 400;
let svg = d3.select("div#map").append("svg").attr("preserveAspectRatio", "xMinYMin meet")
        .attr("viewBox", "0 0 " + width + " " + height).style("background","white")
var projection = d3.geoMercator().scale(4000).center([120.3,24]).translate([width/2,height/2]);
var path = d3.geoPath().projection(projection);
fetch('tmpServer/TaiwanCountySimplify.json')
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
});
