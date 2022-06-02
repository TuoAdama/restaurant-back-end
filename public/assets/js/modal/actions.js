$('.showJustification').on('click', function (e) {

    const content = $("#justificatif-container")
        .text($(this).data('contenu'))
        .clone()
        .show();

    initModal({ content, onClickAction: null, title: 'Jusficatif' });
    $('#modal').modal('show');
})

//Action du boutton pour ajouter un justificatif
$('#add-plat-btn').on('click', function (e) {

    console.log('Hello, world');

    let content = $('#aform-plat').clone().show();

    initModal({ content, onClicknuAction: null, title: 'Ajouter un element à la liste' }); 

    $('#modal').modal('show');

})