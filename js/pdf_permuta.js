document.getElementById('gerarPdf').addEventListener('click', function () {
    // Crie uma nova instância de jsPDF
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('p', 'pt', 'a4');

    // Adicione um cabeçalho
    doc.setFontSize(18);
    doc.text('REQUERIMENTO DE PERMUTA DE ESCALA DE SERVIÇO', doc.internal.pageSize.getWidth() / 2, 40, { align: 'center' });

    // Captura o conteúdo da div usando html2canvas
    var elementHTML = document.querySelector('.card-body');

    // Converter o conteúdo HTML para canvas
    html2canvas(elementHTML, {
        scale: 2
    }).then(function (canvas) {
        var imgData = canvas.toDataURL('../img/brasao-2Bptur.png');
        var imgWidth = 190; // Largura da imagem no PDF
        var pageHeight = doc.internal.pageSize.getHeight();
        var imgHeight = (canvas.height * imgWidth) / canvas.width;
        var position = 60; // Posição inicial no PDF

        // Adicionar a imagem capturada no PDF
        doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);

        // Rodapé
        var pageCount = doc.internal.getNumberOfPages();
        doc.setFontSize(10);
        doc.text('Página ' + pageCount, doc.internal.pageSize.getWidth() / 2, pageHeight - 20, { align: 'center' });

        // Salvar o PDF com o nome especificado
        doc.save('detalhes_permutas.pdf');
    });
});