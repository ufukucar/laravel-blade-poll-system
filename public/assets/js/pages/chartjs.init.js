!(function (d) {
    "use strict";
    function r() {}
    (r.prototype.respChart = function (r, o, e, a) {
        (Chart.defaults.global.defaultFontColor = "#adb5bd"), (Chart.defaults.scale.gridLines.color = "rgba(108, 120, 151, 0.1)");
        var t = r.get(0).getContext("2d"),
            n = d(r).parent();
        function i() {
            r.attr("width", d(n).width());
            switch (o) {
                case "Line":
                    new Chart(t, { type: "line", data: e, options: a });
                    break;
                case "Doughnut":
                    new Chart(t, { type: "doughnut", data: e, options: a });
                    break;
                case "Pie":
                    new Chart(t, { type: "pie", data: e, options: a });
                    break;
                case "Bar":
                    new Chart(t, { type: "bar", data: e, options: a });
                    break;
                case "Radar":
                    new Chart(t, { type: "radar", data: e, options: a });
                    break;
                case "PolarArea":
                    new Chart(t, { data: e, type: "polarArea", options: a });
            }
        }
        d(window).resize(i), i();
    }),
        (r.prototype.init = function () {
            this.respChart(
                d("#lineChart"),
                "Line",
                {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
                    datasets: [
                        {
                            label: "Sales Analytics",
                            fill: !0,
                            lineTension: 0.5,
                            backgroundColor: "rgba(122, 111, 190, 0.2)",
                            borderColor: "#3eb7ba",
                            borderCapStyle: "butt",
                            borderDash: [],
                            borderDashOffset: 0,
                            borderJoinStyle: "miter",
                            pointBorderColor: "#3eb7ba",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#3eb7ba",
                            pointHoverBorderColor: "#fff",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [65, 59, 80, 81, 56, 55, 40, 55, 30, 80],
                        },
                        {
                            label: "Monthly Earnings",
                            fill: !0,
                            lineTension: 0.5,
                            backgroundColor: "rgba(235, 239, 242, 0.2)",
                            borderColor: "#ebeff2",
                            borderCapStyle: "butt",
                            borderDash: [],
                            borderDashOffset: 0,
                            borderJoinStyle: "miter",
                            pointBorderColor: "#ebeff2",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#ebeff2",
                            pointHoverBorderColor: "#eef0f2",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [80, 23, 56, 65, 23, 35, 85, 25, 92, 36],
                        },
                    ],
                },
                { scales: { yAxes: [{ ticks: { max: 100, min: 20, stepSize: 10 } }] } }
            );
            this.respChart(d("#doughnut"), "Doughnut", { labels: ["Desktops", "Tablets"], datasets: [{ data: [300, 210], backgroundColor: ["#3eb7ba", "#ebeff2"], hoverBackgroundColor: ["#3eb7ba", "#ebeff2"], hoverBorderColor: "#fff" }] });
            this.respChart(d("#pie"), "Pie", { labels: ["Desktops", "Tablets"], datasets: [{ data: [300, 180], backgroundColor: ["#36508b", "#ebeff2"], hoverBackgroundColor: ["#36508b", "#ebeff2"], hoverBorderColor: "#fff" }] });
            this.respChart(d("#bar"), "Bar", {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{ label: "Sales Analytics", backgroundColor: "#36508b", borderColor: "#36508b", borderWidth: 1, hoverBackgroundColor: "#36508b", hoverBorderColor: "#36508b", data: [65, 59, 81, 45, 56, 80, 50, 20] }],
            });
            this.respChart(d("#radar"), "Radar", {
                labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
                datasets: [
                    {
                        label: "Desktops",
                        backgroundColor: "rgba(179,181,198,0.2)",
                        borderColor: "rgba(179,181,198,1)",
                        pointBackgroundColor: "rgba(179,181,198,1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(179,181,198,1)",
                        data: [65, 59, 90, 81, 56, 55, 40],
                    },
                    {
                        label: "Tablets",
                        backgroundColor: "rgba(122, 111, 190, 0.2)",
                        borderColor: "#3eb7ba",
                        pointBackgroundColor: "#3eb7ba",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#3eb7ba",
                        data: [28, 48, 40, 19, 96, 27, 100],
                    },
                ],
            });
            this.respChart(d("#polarArea"), "PolarArea", {
                datasets: [{ data: [11, 16, 7, 18], backgroundColor: ["#ffbb44", "#36508b", "#ebeff2", "#3eb7ba"], label: "My dataset", hoverBorderColor: "#fff" }],
                labels: ["Series 1", "Series 2", "Series 3", "Series 4"],
            });
        }),
        (d.ChartJs = new r()),
        (d.ChartJs.Constructor = r);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.ChartJs.init();
    })();
