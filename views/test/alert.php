<div id="PromiseConfirm" class="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-check-circle text-success"></i> <span>Confirm app request</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = () => {
        window.confirm = (message) => {
            $('#PromiseConfirm .modal-body p').html(message);
            var PromiseConfirm = $('#PromiseConfirm').modal({
                keyboard: false,
                backdrop: 'static'
            }).modal('show');
            let confirm = false;
            $('#PromiseConfirm .btn-success').on('click', e => {
                confirm = true;
            });
            return new Promise(function (resolve, reject) {
                PromiseConfirm.on('hidden.bs.modal', (e) => {
                    resolve(confirm);
                });
            });
        };
    }

    let bla = confirm('bla');
    if(bla){
        alert('bla');
    }
</script>
