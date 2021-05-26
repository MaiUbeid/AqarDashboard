import React from 'react';
import propTypes from 'prop-types';
import { Doughnut } from 'react-chartjs-2';
// import { getCities } from 'app/services/settingsServcie';

const DoughnutChart = ({ chartData, amounts }) => {

    let customLabels = chartData.map((item) => `${item.name}: ${item.value}`)

    const data = {
        labels: customLabels,
        datasets: [
            {
                data: amounts,
                backgroundColor: ['#FFD44C', '#999BD2', '#B76569', '#1F7BCA', '#C0392B', '#E74C3C', '#E74C3C', '#E74C3C', '#3498DB', '#1ABC9C', '#1ABC9C', '#1ABC9C', '#1ABC9C'],
            },
        ],
    };

    const getCities = () => {
    }

    return (
        <div>
            <Doughnut
                data={data}
                width={80}
                height={48}
                options={{
                    cutoutPercentage: 60,
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var dataLabel = data.labels[tooltipItem.index];
                                return dataLabel;
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'right',
                        onClick: getCities()
                    },
                    plugins: {
                        datalabels: {
                            display: true,
                        },
                    },
                    elements: {
                        arc: {
                            borderWidth: 0,
                        }
                    },
                }}
            />
        </div>
    );
};

DoughnutChart.propTypes = {
    chartData: propTypes.arrayOf(propTypes.object).isRequired,
    amounts: propTypes.arrayOf(propTypes.number).isRequired,
};

export default DoughnutChart;