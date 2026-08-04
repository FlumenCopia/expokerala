

// LOADER

const lo = gsap.timeline();
const welcomeScreen = gsap.timeline({
  paused: "true",
});
lo.from(".title", {
  duration: 0.5,
  opacity: 0,
  y: 10,
});
lo.from(".bracket", {
  duration: 0.3,
  scale: 0,
  margin: 0,
});
lo.from("#loader", {
  duration: 0.2,
  scale: 0,
});
lo.from(".title-d", {
  duration: 1,
  opacity: 0,
  delay: 2.4,
});

lo.from(
  ".bottom-line",
  {
    duration: 0.5,
    y: 50,
    opacity: 0,
    stagger: {
      amount: 0.1,
    },
  },
  "-=.5"
);

// open video

// Gallery
$(".gallery-magnific").magnificPopup({
  type: "iframe",
  gallery: {
    enabled: true,
  },
  image: {
    titleSrc: function (item) {
      return (
        item.el.find(".title").html() +
        `<small>${item.el.find(".author").html()}</small>`
      );
    },
  },
});

// open video close

// open image

$(".gallery-magnific2").magnificPopup({
  type: "image",
  gallery: {
    enabled: true,
  },
  image: {
    titleSrc: function (item) {
      return (
        item.el.find(".title").html() +
        `<small>${item.el.find(".author").html()}</small>`
      );
    },
  },
});


// open image close

 document.addEventListener("DOMContentLoaded", function() {
            const charts = document.querySelectorAll(".chart");

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const value = parseInt(el.dataset.value, 10);

                        // Determine color
                        let chartColor;
                        if (value < 100) chartColor = "#e7a001";

                        const options = {
                            chart: {
                                width: "100%",
                                type: "radialBar"
                            },
                            series: [value],
                            colors: [chartColor],
                            stroke: {
                                lineCap: "round"
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        size: "55%"
                                    },
                                    track: {
                                        background: "#e2e2e2ff"
                                    },
                                    dataLabels: {
                                        name: {
                                            show: true,
                                            offsetY: 20,
                                            color: "#888",
                                            fontSize: "16px"
                                        },
                                        value: {
                                            show: true,
                                            fontSize: "25px",
                                            fontWeight: "bold",
                                            color: "#000000ff",
                                            offsetY: -10
                                        }
                                    }
                                }
                            },
                            labels: [""]
                        };

                        new ApexCharts(el, options).render();
                        observer.unobserve(el); // Stop watching this one
                    }
                });
            }, {
                root: null,
                rootMargin: "0px 0px -20% 0px", // trigger when bottom hits screen bottom
                threshold: 0
            });

            charts.forEach(chart => observer.observe(chart));
        });


        document.addEventListener("DOMContentLoaded", function() {
            const bars = document.querySelectorAll(".progress-bar");

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const value = el.getAttribute("aria-valuenow");
                        $(el).css("width", value + "%");
                        observer.unobserve(el); // Run only once per bar
                    }
                });
            }, {
                root: null,
                rootMargin: "0px 0px -20% 0px", // trigger when near bottom
                threshold: 0
            });

            bars.forEach(bar => observer.observe(bar));
        });


// auto count number


// auto count number close




