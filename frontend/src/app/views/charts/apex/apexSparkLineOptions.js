const basicOptions = {
  stroke: {
    width: 1
  },
  markers: {
    size: 0
  },
  tooltip: {
    fixed: {
      enabled: true
    }
  }
};

//   spark One
export const randomizeArray = arg => {
  let array = arg.slice();
  let currentIndex = array.length,
    temporaryValue,
    randomIndex;

  while (0 !== currentIndex) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
};

const sparklineData = [
  47,
  45,
  54,
  38,
  56,
  24,
  65,
  31,
  37,
  39,
  62,
  51,
  35,
  41,
  35,
  27,
  93,
  53,
  61,
  27,
  54,
  43,
  19,
  46
];

export const options1 = {
  ...basicOptions,
  chart: {
    type: "area",
    height: 160,
    sparkline: {
      enabled: true
    }
  },

  stroke: {
    curve: "straight"
  },
  fill: {
    opacity: 0.3
  },
  series: [
    {
      data: randomizeArray(sparklineData)
    }
  ],
  yaxis: {
    min: 0
  },
  colors: ["#DCE6EC"]
};

export const options2 = {
  ...basicOptions,
  chart: {
    type: "area",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  stroke: {
    curve: "straight"
  },
  fill: {
    opacity: 0.3
  },
  series: [
    {
      data: randomizeArray(sparklineData)
    }
  ],
  yaxis: {
    min: 0
  },
  colors: ["#639"]
};

export const options3 = {
  ...basicOptions,
  chart: {
    type: "area",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  stroke: {
    curve: "straight"
  },
  fill: {
    opacity: 0.3
  },
  series: [
    {
      data: randomizeArray(sparklineData)
    }
  ],
  xaxis: {
    crosshairs: {
      width: 1
    }
  },
  yaxis: {
    min: 0
  }
};

export const options4 = {
  ...basicOptions,
  chart: {
    type: "area",
    width: "100%",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  stroke: {
    curve: "smooth",
    lineCap: "round"
  },
  series: [
    {
      data: [15, 75, 47, 65, 14, 2, 41, 54, 4, 27, 15]
    }
  ],
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function(seriesName) {
          return "";
        }
      }
    },
    marker: {
      show: false
    }
  }
};

export const options5 = {
  ...basicOptions,
  chart: {
    type: "bar",
    width: "100%",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    bar: {
      columnWidth: "60%",
      endingShape: "rounded"
    }
  },
  colors: ["#72c2ff"],
  series: [
    {
      data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 30, 40, 50]
    }
  ],
  labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
  xaxis: {
    crosshairs: {
      width: 1
    }
  },
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function(seriesName) {
          return "";
        }
      }
    },
    marker: {
      show: false
    }
  }
};

export const options6 = {
  ...basicOptions,
  chart: {
    type: "bar",
    width: "100%",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    bar: {
      columnWidth: "60%"
    }
  },
  colors: ["#08e5e8"],

  series: [
    {
      data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14, 30, 50]
    }
  ],
  labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
  xaxis: {
    crosshairs: {
      width: 1
    }
  },
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function(seriesName) {
          return "";
        }
      }
    },
    marker: {
      show: false
    }
  }
};

export const options7 = {
  ...basicOptions,
  chart: {
    type: "bar",
    width: "100%",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    bar: {
      columnWidth: "80%",
      endingShape: "rounded"
    }
  },
  colors: ["#a890d3"],
  series: [
    {
      data: [47, 45, 74, 14, 56, 74, 14, 11, 7, 39, 82]
    }
  ],
  labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
  xaxis: {
    crosshairs: {
      width: 1
    }
  },
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function(seriesName) {
          return "";
        }
      }
    },
    marker: {
      show: false
    }
  }
};

export const options8 = {
  ...basicOptions,
  chart: {
    type: "bar",
    width: "100%",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    bar: {
      columnWidth: "50%",
      endingShape: "rounded"
    }
  },
  colors: ["#dd5e89"],
  fill: {
    type: "gradient",
    gradient: {
      shade: "dark",
      gradientToColors: ["#dd5e89"],
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.9
    }
  },
  series: [
    {
      data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 40, 60, 20]
    }
  ],
  labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
  xaxis: {
    crosshairs: {
      width: 1
    }
  },
  tooltip: {
    fixed: {
      enabled: false
    },
    x: {
      show: false
    },
    y: {
      title: {
        formatter: function(seriesName) {
          return "";
        }
      }
    },
    marker: {
      show: false
    }
  }
};

export const options9 = {
  ...basicOptions,
  chart: {
    type: "area",
    height: 160,
    sparkline: {
      enabled: true
    }
  },

  stroke: {
    curve: "straight"
  },
  fill: {
    opacity: 0.3
  },
  series: [
    {
      data: randomizeArray(sparklineData)
    }
  ],
  yaxis: {
    min: 0
  },
  colors: ["#DCE6EC"]
  // title: {
  //     text: '$424,652',
  //     offsetX: 0,
  //     style: {
  //         fontSize: '24px',
  //         cssClass: 'apexcharts-yaxis-title'
  //     }
  // },
  // subtitle: {
  //     text: 'Sales',
  //     offsetX: 0,
  //     style: {
  //         fontSize: '14px',
  //         cssClass: 'apexcharts-yaxis-title'
  //     }
  // }
};

export const options10 = {
  ...basicOptions,
  chart: {
    type: "area",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  stroke: {
    curve: "straight"
  },
  fill: {
    opacity: 0.3
  },
  series: [
    {
      data: randomizeArray(sparklineData)
    }
  ],
  yaxis: {
    min: 0
  },
  colors: ["#639"]
  // title: {
  //     text: '$235,312',
  //     offsetX: 0,
  //     style: {
  //         fontSize: '24px',
  //         cssClass: 'apexcharts-yaxis-title'
  //     }
  // },
  // subtitle: {
  //     text: 'Expenses',
  //     offsetX: 0,
  //     style: {
  //         fontSize: '14px',
  //         cssClass: 'apexcharts-yaxis-title'
  //     }
  // }
};

export const options11 = {
  ...basicOptions,
  chart: {
    type: "area",
    height: 160,
    sparkline: {
      enabled: true
    }
  },
  stroke: {
    curve: "straight"
  },
  fill: {
    opacity: 0.3
  },
  series: [
    {
      data: randomizeArray(sparklineData)
    }
  ],
  xaxis: {
    crosshairs: {
      width: 1
    }
  },
  yaxis: {
    min: 0
  }
  // title: {
  //     text: '$135,965',
  //     offsetX: 0,
  //     style: {
  //         fontSize: '24px',
  //         cssClass: 'apexcharts-yaxis-title'
  //     }
  // },
  // subtitle: {
  //     text: 'Profits',
  //     offsetX: 0,
  //     style: {
  //         fontSize: '14px',
  //         cssClass: 'apexcharts-yaxis-title'
  //     }
  // }
};
