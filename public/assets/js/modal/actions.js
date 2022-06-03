$('#add-plat-btn').on('click', function (e) {

    let content = $('#form-plat').clone().show();

    initModal({ content, onClicknuAction: null, title: 'Ajouter un element à la liste' });

})

$(".edit-plat").click(function (e) {

});

$(".delete-plat").click(function (e) {
    let id = $(this).data('id')
    var onClickAction = async function () {
        fetch('/api/plats/'+id).then(response => response)
          .then(response => window.location.reload())
    }

    initModal({ content: "", onClickAction, title: 'Voulez-vous supprimer cet élément ?' });
})