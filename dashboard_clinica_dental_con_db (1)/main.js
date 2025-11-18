const tooltip = d3.select("body").append("div").attr("class", "tooltip");

document.getElementById("btnFiltrar").addEventListener("click", () => {
  const fecha = document.getElementById("fechaFiltro").value;
  cargarDatos(fecha);
});

document.getElementById("btnDescargar").addEventListener("click", () => {
  window.location.href = "descargar_datos.php";
});

function cargarDatos(fecha = "") {
  fetch("data.php?fecha=" + fecha)
    .then(res => res.json())
    .then(data => {
      dibujarBarras(data.estado, "#graficoEstado", "estado");
      dibujarBarras(data.doctores, "#graficoDoctores", "doctor");
    });
}

function dibujarBarras(datos, selector, categoria) {
  const svg = d3.select(selector);
  svg.selectAll("*").remove();

  const width = +svg.attr("width");
  const height = +svg.attr("height");
  const margin = 40;

  const x = d3.scaleBand()
    .domain(datos.map(d => d[categoria]))
    .range([margin, width - margin])
    .padding(0.1);

  const y = d3.scaleLinear()
    .domain([0, d3.max(datos, d => d.cantidad)])
    .range([height - margin, margin]);

  svg.append("g").attr("transform", `translate(0,${height - margin})`).call(d3.axisBottom(x));
  svg.append("g").attr("transform", `translate(${margin},0)`).call(d3.axisLeft(y));

  svg.selectAll("rect")
    .data(datos)
    .join("rect")
    .attr("x", d => x(d[categoria]))
    .attr("y", d => y(d.cantidad))
    .attr("width", x.bandwidth())
    .attr("height", d => height - margin - y(d.cantidad))
    .attr("fill", "teal")
    .on("mouseover", (event, d) => {
      tooltip.text(`${d[categoria]}: ${d.cantidad}`).style("visibility", "visible");
    })
    .on("mousemove", event => {
      tooltip.style("top", (event.pageY - 10) + "px").style("left", (event.pageX + 10) + "px");
    })
    .on("mouseout", () => tooltip.style("visibility", "hidden"));
}

cargarDatos();