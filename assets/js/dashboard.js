$(document).ready(function () {
  $("#detailKaryawan").click(function () {
    $.LoadingOverlay("show");
    $("#detailkarysum").modal("show");
    $("#tbmJmlKryPrs").load(site_url + "dash/show_jml_kary?ta=0");
  });

  $("#btnResetFilter").click(function () {
    $.LoadingOverlay("show");
    $("#tbmJmlKryPrs").load(site_url + "dash/show_jml_kary?ta=0");
  });

  $("#btnFilterJmlKary").click(function () {
    $.LoadingOverlay("show");
    $("#filtertglkarysum").modal("hide");

    let tglaktif = $("#txtTglAktifPRs").val();
    $("#tbmJmlKryPrs").load(site_url + "dash/show_jml_kary?ta=" + tglaktif);
  });

  $("#btnFilterDOH").click(function () {
    $.LoadingOverlay("show");
    $("#filtertglkarysum").modal("show");
    $.LoadingOverlay("hide");
  });
  $(function () {
    var options = {
      chart: {
        height: 764,
        type: "bar",
      },
      plotOptions: {
        bar: {
          horizontal: true,
          dataLabels: {
            position: "top",
          },
        },
      },
      dataLabels: {
        enabled: true,
      },
      colors: ["#0e9e4a", "#4680ff", "#ff5252"],
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      series: [],
      noData: {
        text: "Loading...",
      },
      yaxis: {
        title: {
          text: "Jumlah Karyawan",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Orang";
          },
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#bar-chart-1"), options);
    chart.render();

    var url = site_url + "dash/gt_data";
    $.getJSON(url, function (response) {
      chart.updateSeries([
        {
          name: "Jml Karyawan : ",
          data: response,
        },
      ]);
    });
  });
  $(function () {
    var options = {
      chart: {
        height: 230,
        type: "bar",
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "top",
          },
        },
      },
      dataLabels: {
        enabled: true,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      series: [],
      noData: {
        text: "Loading...",
      },
      yaxis: {
        title: {
          text: "Jenis Kelamin",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Orang";
          },
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#bar-chart-2"), options);
    chart.render();

    var url = site_url + "dash/gt_gender";
    $.getJSON(url, function (response) {
      chart.updateSeries([
        {
          name: "Jml Karyawan : ",
          data: response,
        },
      ]);
    });
  });
  $(function () {
    var options = {
      chart: {
        height: 230,
        type: "bar",
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "top",
          },
        },
      },
      dataLabels: {
        enabled: true,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      series: [],
      noData: {
        text: "Loading...",
      },
      yaxis: {
        title: {
          text: "Lokasi Terima",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Orang";
          },
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#bar-chart-3"), options);
    chart.render();

    var url = site_url + "dash/gt_jlok";
    $.getJSON(url, function (response) {
      chart.updateSeries([
        {
          name: "Jml Karyawan : ",
          data: response,
        },
      ]);
    });
  });
  $(function () {
    var options = {
      chart: {
        height: 300,
        type: "bar",
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "top",
          },
        },
      },
      dataLabels: {
        enabled: true,
      },
      colors: ["#0e9e4a", "#4680ff", "#ff5252"],
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      series: [],
      noData: {
        text: "Loading...",
      },
      yaxis: {
        title: {
          text: "Klasifikasi",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Orang";
          },
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#bar-chart-4"), options);
    chart.render();

    var url = site_url + "dash/gt_kls";
    $.getJSON(url, function (response) {
      chart.updateSeries([
        {
          name: "Jml Karyawan : ",
          data: response,
        },
      ]);
    });
  });
  $(function () {
    var options = {
      chart: {
        height: 300,
        type: "bar",
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "top",
          },
        },
      },
      dataLabels: {
        enabled: true,
      },
      colors: ["#0e9e4a", "#4680ff", "#ff5252"],
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      series: [],
      noData: {
        text: "Loading...",
      },
      yaxis: {
        title: {
          text: "Pendidikan",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Orang";
          },
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#bar-chart-5"), options);
    chart.render();

    var url = site_url + "dash/gt_didik";
    $.getJSON(url, function (response) {
      chart.updateSeries([
        {
          name: "Jml Karyawan : ",
          data: response,
        },
      ]);
    });
  });
  $(function () {
    var options = {
      chart: {
        height: 300,
        type: "bar",
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "top",
          },
        },
      },
      dataLabels: {
        enabled: true,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      series: [],
      noData: {
        text: "Loading...",
      },
      yaxis: {
        title: {
          text: "Status Tinggal",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Orang";
          },
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#bar-chart-6"), options);
    chart.render();

    var url = site_url + "dash/gt_stt_tinggal";
    $.getJSON(url, function (response) {
      chart.updateSeries([
        {
          name: "Jml Karyawan : ",
          data: response,
        },
      ]);
    });
  });
  $(function () {
    var options = {
      chart: {
        height: 300,
        type: "bar",
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "top",
          },
        },
      },
      dataLabels: {
        enabled: true,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      series: [],
      noData: {
        text: "Loading...",
      },
      yaxis: {
        title: {
          text: "Sertifikasi",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Orang";
          },
        },
      },
    };
    var chart = new ApexCharts(document.querySelector("#bar-chart-7"), options);
    chart.render();

    var url = site_url + "dash/gt_srt";
    $.getJSON(url, function (response) {
      chart.updateSeries([
        {
          name: "Jml Karyawan : ",
          data: response,
        },
      ]);
    });
  });
});
