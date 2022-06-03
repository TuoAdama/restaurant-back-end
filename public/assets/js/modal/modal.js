let modalBody = $("#modal-body");
let validateBtn = $('#valid-modal-btn');
let modalTitle = $('#modal-title');

function initModal({
    content,
    onClickAction,
    title
}) {
    modalBody.empty();
    modalTitle.text('');
    validateBtn.off('click');
    validateBtn.hide();

    if(onClickAction){
        validateBtn.show();
        validateBtn.click(onClickAction);
    }

    if(title !== undefined){
        modalTitle.text(title);
    }
    
    modalBody.append(content)
    $('#modal').modal('show');
}