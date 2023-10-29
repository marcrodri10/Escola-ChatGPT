
<!-- Modal -->
<form action="cookiesPolicyController" method="POST">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cookies policy</h1>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close" name="cookies" value="false"></button>
            </div>
            <div class="modal-body">
                Accept cookies policy
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="cookies" value="true">Accept</button>
            </div>
            </div>
        </div>
    </div>
</form>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById("staticBackdrop"));
        modal.show();
    });
</script>