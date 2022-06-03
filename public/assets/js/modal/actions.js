$('#add-plat-btn').on('click', function (e) {

    console.log('Hello, world');

    let content = $('#aform-plat').clone().show();

    initModal({ content, onClicknuAction: null, title: 'Ajouter un element à la liste' }); 

})