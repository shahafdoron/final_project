// Apex.grid = {
//   padding: {
//     right: 0,
//     left: 0
//   }
// }
//
Apex.yaxis = {
  forceNiceScale: true
}




// the default colorPalette for this dashboard
var colorPalette = ['#01BFD6', '#5564BE', '#F7A600', '#EDCD24', '#F74F58'];
// var colorPalette = ['#00D8B6','#008FFB',  '#FEB019', '#FF4560', '#775DD0'];





//histogram
var optionsGrouped = {
  chart: {
    height: 350,
    type: 'bar',
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '45%',
    },
  },
  dataLabels: {
    enabled: true
  },
  stroke: {
    width: 2,
    colors: ['transparent']
  },
  series: [{
    name: 'Guided Tour Visitors',
    data: count_participants_tour[1]
  }, {
    name: 'indepentent Tour Visitors',
    data: count_participants_tour[2]
  }],
  xaxis: {
    categories: count_participants_tour[0]
  },
  yaxis: {
    min: 0,
    forceNiceScale: true,
    title: {
      text: 'Visitors'
    },
  },
  fill: {
    opacity: 1

  },
  title: {
    text: 'Monthly Visitors',
    align: 'left',
    style: {
      fontSize: '18px'
    }
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return  val + " Visitors"
      }
    }
  }
}
var chartArea = new ApexCharts(document.querySelector('#area'), optionsGrouped);
chartArea.render();
//============================================================
//stacked bar -
var optionsBar = {
  chart: {
    type: 'bar',
    height: 380,
    width: '100%',
    stacked: true,
    toolbar: {
      show: true
    },
  },
  dataLabels: {
    enabled: true
  },
  responsive: [{
    breakpoint: 480,
    options: {
      legend: {
        position: 'bottom',
        offsetX: -10,
        offsetY: 0
      }
    }
  }],
  plotOptions: {
    bar: {
      columnWidth: '45%',
    }
  },
  colors: colorPalette,
  series: [{
    name: "indepentent Tour Visitors",
    data: cate_count[2],
  }, {
    name: "Guided Tour Visitors",
    data: cate_count[1],
  }],
  labels: cate_count[0],
  xaxis: {
    labels: {
      show: true
    },
    axisBorder: {
      show: true
    },
    axisTicks: {
      show: true
    },
  },
  yaxis: {
    min: 0,
    forceNiceScale: true,
    title: {
      text: 'Visitors'
    },
    axisBorder: {
      show: true
    },
    axisTicks: {
      show: true
    },
    labels: {
      style: {
        color: '#78909c'
      }
    }
  },
  title: {
    text: 'Visitors by Category',
    align: 'left',
    style: {
      fontSize: '18px'
    }
  }

}
var chartBar = new ApexCharts(document.querySelector('#bar'), optionsBar);
chartBar.render();
//=========================================================
//donut - category
var optionDonut = {
  chart: {
    width: '100%',
    type: 'donut',
    toolbar: {
      show: true,
      tools: {
        download: true
      }
    }

  },
  colors: colorPalette,
  title: {
    text: 'Total Tours by Category',
    style: {
      fontSize: '18px'
    }
  },

  labels: count_tour_points_category[0],
  series: count_tour_points_category[1],
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'left',
        offsetY: 80
      }
    }
  }],
  legend: {
    position: 'left',
    offsetY: 80
  }
}
var donut = new ApexCharts(document.querySelector("#donut"),optionDonut);
donut.render();
//========================================================
//line -
var options = {
  chart: {
    height: 350,
    type: 'line'
  },

  stroke: {
    width: 5,
    curve: 'straight'
  },
  markers: {
    size: 5
  },
  series: [{
    name: "Users",
    data: count_user[1]
  }],
  title: {
    floating: false,
    text: 'Users Growth',
    align: 'left',
    style: {
      fontSize: '18px'
    }
  },
  subtitle: {
    text: 'Total Users(last year): '+count_user[2],
    align: 'center',
    margin: 30,
    offsetY: 40,
    style: {
      color: '#222',
      fontSize: '18px',
    }
  },
  grid: {
    row: {
      colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
      opacity: 1
    },
  },
  xaxis: {
    categories: count_user[0],
  },
  yaxis: {
    min: 0,
    forceNiceScale: true,
    max: Math.max.apply(null, count_user[1]),
    title: {
      text: 'Users'
    }
  },
};
var chartLine = new ApexCharts(document.querySelector('#line'), options);
// a small hack to extend height in website sample dashboard
chartLine.render().then(function () {
  var ifr = document.querySelector("#wrapper");
  if (ifr.contentDocument) {
    ifr.style.height = ifr.contentDocument.body.scrollHeight + 15 + 'px';
  }
});
//
//
// // on smaller screen, change the legends position for donut
// var mobileDonut = function() {
//   if($(window).width() < 768) {
//     donut.updateOptions({
//       plotOptions: {
//         pie: {
//           offsetY: -15,
//         }
//       },
//       legend: {
//         position: 'bottom'
//       }
//     }, false, false)
//   }
//   else {
//     donut.updateOptions({
//       plotOptions: {
//         pie: {
//           offsetY: 20,
//         }
//       },
//       legend: {
//         position: 'left'
//       }
//     }, false, false)
//   }
// }
//
// $(window).resize(function() {
//   mobileDonut()
// })
