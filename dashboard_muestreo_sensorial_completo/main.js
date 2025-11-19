function cargarDatos() {
  const fecha = document.getElementById("fecha").value;
  const comuna = document.getElementById("comuna").value;
  const url = `consulta.php?fecha=${fecha}&comuna=${comuna}`;
  fetch(url)
    .then(r => r.json())
    .then(data => {
      renderLinea(data);
      renderBarras(data);
      renderDona(data);
      renderPuntos(data);
      window.ultimaData = data;
    });
}

function renderLinea(data) {
  const svg = d3.select("#graf_linea");
  svg.selectAll("*").remove();

  const dias = d3.rollups(data, v => d3.mean(v, d => +d.temperatura), d => d.fecha).sort();
  const x = d3.scalePoint().domain(dias.map(d => d[0])).range([50, 550]);
  const y = d3.scaleLinear().domain([0, d3.max(dias, d => d[1])]).range([250, 50]);

  svg.append("g").attr("transform", "translate(0,250)").call(d3.axisBottom(x));
  svg.append("g").attr("transform", "translate(50,0)").call(d3.axisLeft(y));

  const line = d3.line()
    .x(d => x(d[0]))
    .y(d => y(d[1]));

  svg.append("path")
    .datum(dias)
    .attr("fill", "none")
    .attr("stroke", "steelblue")
    .attr("stroke-width", 2)
    .attr("d", line);
}

function renderBarras(data) {
  const svg = d3.select("#graf_barras");
  svg.selectAll("*").remove();

  const bins = d3.bin().thresholds(10).value(d => +d.ph)(data);
  const x = d3.scaleBand().domain(bins.map(d => d.x0.toFixed(1))).range([50, 550]).padding(0.1);
  const y = d3.scaleLinear().domain([0, d3.max(bins, d => d.length)]).range([250, 50]);

  svg.append("g").attr("transform", "translate(0,250)").call(d3.axisBottom(x).tickValues(x.domain()));
  svg.append("g").attr("transform", "translate(50,0)").call(d3.axisLeft(y));

  svg.selectAll("rect")
    .data(bins)
    .enter()
    .append("rect")
    .attr("x", d => x(d.x0.toFixed(1)))
    .attr("y", d => y(d.length))
    .attr("width", x.bandwidth())
    .attr("height", d => 250 - y(d.length))
    .attr("fill", "#007bff");
}

function renderDona(data) {
  const svg = d3.select("#graf_dona");
  svg.selectAll("*").remove();

  const turb = d3.rollups(data, v => v.length, d => {
    if (d.turbidez < 4) return "Baja";
    else if (d.turbidez < 5.5) return "Media";
    else return "Alta";
  });

  const pie = d3.pie().value(d => d[1]);
  const arc = d3.arc().innerRadius(50).outerRadius(100);
  const color = d3.scaleOrdinal().domain(turb.map(d => d[0])).range(d3.schemeSet2);

  const g = svg.append("g").attr("transform", "translate(300,150)");

  g.selectAll("path")
    .data(pie(turb))
    .enter()
    .append("path")
    .attr("d", arc)
    .attr("fill", d => color(d.data[0]));
}

function renderPuntos(data) {
  const svg = d3.select("#graf_puntos");
  svg.selectAll("*").remove();

  const x = d3.scaleLinear().domain([d3.min(data, d => +d.caudal), d3.max(data, d => +d.caudal)]).range([50, 550]);
  const y = d3.scaleLinear().domain([d3.min(data, d => +d.oxigeno_disuelto), d3.max(data, d => +d.oxigeno_disuelto)]).range([250, 50]);

  svg.append("g").attr("transform", "translate(0,250)").call(d3.axisBottom(x));
  svg.append("g").attr("transform", "translate(50,0)").call(d3.axisLeft(y));

  svg.selectAll("circle")
    .data(data)
    .enter()
    .append("circle")
    .attr("cx", d => x(+d.caudal))
    .attr("cy", d => y(+d.oxigeno_disuelto))
    .attr("r", 4)
    .attr("fill", "#28a745");
}

function descargarSVGs() {
  document.querySelectorAll("svg").forEach((svg, i) => {
    const blob = new Blob([new XMLSerializer().serializeToString(svg)], {type: "image/svg+xml"});
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = `grafico_${i + 1}.svg`;
    a.click();
  });
}

function descargarPNGs() {
  document.querySelectorAll("svg").forEach((svg, i) => {
    const canvas = document.createElement("canvas");
    canvas.width = svg.clientWidth;
    canvas.height = svg.clientHeight;
    const ctx = canvas.getContext("2d");
    const img = new Image();
    const data = new XMLSerializer().serializeToString(svg);
    const svgBlob = new Blob([data], {type: "image/svg+xml;charset=utf-8"});
    const url = URL.createObjectURL(svgBlob);
    img.onload = function() {
      ctx.drawImage(img, 0, 0);
      const png = canvas.toDataURL("image/png");
      const a = document.createElement("a");
      a.href = png;
      a.download = `grafico_${i + 1}.png`;
      a.click();
    };
    img.src = url;
  });
}

function descargarExcel() {
  const data = window.ultimaData;
  const headers = Object.keys(data[0]);
  const rows = data.map(d => headers.map(h => d[h]));
  let csv = headers.join(",") + "\n" + rows.map(r => r.join(",")).join("\n");

  const blob = new Blob([csv], {type: "text/csv"});
  const a = document.createElement("a");
  a.href = URL.createObjectURL(blob);
  a.download = "datos.csv";
  a.click();
}

cargarDatos();