$(document).ready(function() {
    // Mapeamento de tipificação para os IDs dos elementos a serem mostrados
    
    const config = {
        '1': ['#tipoFurto'],
        '2': ['#tipoRoubo'],
        '3': ['#tipoReceptacao'],
        '12': ['#tipoGenero', '#idade', '#tipoArma'],
        '13': ['#tipoGenero', '#idade', '#tipoArma'],
        '14': ['#tipoGenero', '#idade', '#tipoArma'],
        '15': ['#tipoGenero', '#idade', '#tipoArma'],
        '23': ['#tipoGenero', '#tipoEtario', '#idade'],
        '27': ['#tipoGenero', '#tipoEtario', '#idade']
            // Continue adicionando quantos quiser
    };
        

    $('#tipificar').on('change', function() {
        const selectedValue = $(this).val();

        // Ocultar todos os elementos associados no mapeamento
        Object.values(config).flat().forEach(selector => $(selector).hide());

        // Mostrar apenas os elementos associados ao valor selecionado
        if (config[selectedValue]) {
            config[selectedValue].forEach(selector => $(selector).show());
        }
    });
});
