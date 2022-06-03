$('#add-plat-btn').on('click', function (e) {

    let content = $('#form-plat').clone().show();

    initModal({ content, onClicknuAction: null, title: 'Ajouter un element à la liste' }); 

})