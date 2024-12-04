document.addEventListener("DOMContentLoaded", () => {
    const averageScoreElement = document.getElementById("averageScore").querySelector("span");
    const totalResponsesElement = document.getElementById("totalResponses").querySelector("span");
    const feedbackCountElement = document.getElementById("feedbackCount").querySelector("span");

    let scoreDistributionChart;

    function carregarDados() {
        fetch("dashboard_data.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP status ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error("Erro nos dados:", data.error);
                    return;
                }
                atualizarMetricas(data.metrics);
                renderizarGrafico(data.chartsData);
            })
            .catch(error => {
                console.error("Erro ao carregar dados:", error);
            });
    }

    function atualizarMetricas(metrics) {
        averageScoreElement.textContent = parseFloat(metrics.averageScore).toFixed(2);
        totalResponsesElement.textContent = metrics.totalResponses || "0";
        feedbackCountElement.textContent = metrics.feedbackCount || "0";
    }

    function renderizarGrafico(chartsData) {
        const ctx = document.getElementById("scoreDistributionChart").getContext("2d");

        if (scoreDistributionChart) {
            scoreDistributionChart.destroy();
        }

        scoreDistributionChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: chartsData.scoreLabels,
                datasets: [{
                    label: "Distribuição de Notas",
                    data: chartsData.scoreDistribution,
                    backgroundColor: "rgba(54, 162, 235, 0.6)"
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    carregarDados();
});
